<?php

namespace App\Repositories;

use App\Exceptions\GeneralException;
use App\Models\Meta;
use App\Models\Post;
use App\Models\PostTranslation;
use App\Models\Tag;
use App\Models\User;
use App\Repositories\Contracts\PostRepository;
use App\Repositories\Contracts\TagRepository;
use App\Repositories\Traits\HtmlActionsButtons;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;
use Mcamara\LaravelLocalization\LaravelLocalization;
use Plank\Mediable\MediaUploader;

/**
 * Class EloquentPostRepository.
 */
class EloquentPostRepository extends EloquentBaseRepository implements PostRepository
{
    use HtmlActionsButtons;

    /**
     * @var \Mcamara\LaravelLocalization\LaravelLocalization
     */
    protected $localization;

    /**
     * @var \App\Repositories\Contracts\TagRepository
     */
    protected $tags;

    /**
     * @var \Plank\Mediable\MediaUploader
     */
    protected $mediaUploader;

    /**
     * EloquentUserRepository constructor.
     *
     * @param Post                                             $post
     * @param \Mcamara\LaravelLocalization\LaravelLocalization $localization
     * @param TagRepository                                    $tags
     * @param \Plank\Mediable\MediaUploader                    $mediaUploader
     */
    public function __construct(
        Post $post,
        LaravelLocalization $localization,
        TagRepository $tags,
        MediaUploader $mediaUploader
    ) {
        parent::__construct($post);
        $this->localization = $localization;
        $this->tags = $tags;
        $this->mediaUploader = $mediaUploader;
    }

    /**
     * @return mixed
     */
    public function published()
    {
        return $this->model
            ->published()
            ->with('owner')
            ->orderByDesc('pinned')
            ->orderByDesc('published_at');
    }

    /**
     * @param Tag $tag
     *
     * @return mixed
     */
    public function publishedByTag(Tag $tag)
    {
        return $this->published()->withTag($tag);
    }

    /**
     * @param \App\Models\User $user
     *
     * @return mixed
     */
    public function publishedByOwner(User $user)
    {
        return $this->published()->withOwner($user);
    }

    /**
     * @param string $slug
     *
     * @return mixed
     */
    public function findBySlug($slug)
    {
        /** @var PostTranslation $postTranslation */
        $postTranslation = PostTranslation::whereSlug($slug)->first();

        if ($postTranslation) {
            return $postTranslation->post;
        }

        return null;
    }

    /**
     * @param Post                               $post
     * @param array                              $input
     * @param \Illuminate\Http\UploadedFile|null $image
     *
     * @throws \App\Exceptions\GeneralException|\Exception|\Throwable
     *
     * @return mixed
     */
    public function saveAndPublish(Post $post, array $input, UploadedFile $image = null)
    {
        $post->status = Post::PUBLISHED;

        return $this->save($post, $input, $image);
    }

    /**
     * @param Post                               $post
     * @param array                              $input
     * @param \Illuminate\Http\UploadedFile|null $image
     *
     * @throws \App\Exceptions\GeneralException|\Exception|\Throwable
     *
     * @return mixed
     */
    public function saveAsDraft(Post $post, array $input, UploadedFile $image = null)
    {
        $post->status = Post::DRAFT;

        return $this->save($post, $input, $image);
    }

    /**
     * @param Post                               $post
     * @param array                              $input
     * @param \Illuminate\Http\UploadedFile|null $image
     *
     * @throws \App\Exceptions\GeneralException|\Exception|\Throwable
     *
     * @return mixed
     */
    private function save(Post $post, array $input, UploadedFile $image = null)
    {
        if ($post->exists) {
            if (!Gate::check('update', $post)) {
                throw new GeneralException(trans('exceptions.backend.posts.save'));
            }
        } else {
            $post->user_id = auth()->id();
        }

        if ($post->status === Post::PUBLISHED && !Gate::check('publish posts')) {
            // User with no publish permissions must go to moderation awaiting
            $post->status = Post::PENDING;
        }

        DB::transaction(function () use ($post, $input, $image) {
            if (!$post->save()) {
                throw new GeneralException(trans('exceptions.backend.posts.save'));
            }

            // Metas
            if (isset($input['meta'])) {
                if (!$post->meta) {
                    $post->meta()->create($input['meta']);
                } else {
                    $post->meta->update($input['meta']);
                }
            }

            // Tags
            if (isset($input['tags'])) {
                // No sync because no where support (localized tags)
                $ids = $post->tags->pluck('id')->toArray();
                $post->tags()->detach($ids);

                foreach (explode(',', $input['tags']) as $tag) {
                    if ($tag = $this->tags->findOrCreate($tag)) {
                        $post->tags()->attach($tag->id);
                    }
                }
            }

            // Featured image
            if ($image) {
                $media = $this->mediaUploader->fromSource($image)
                    ->toDestination('public', 'posts')
                    ->useFilename(Str::random(32))
                    ->upload();

                $post->handleMediableDeletion();
                $post->attachMedia($media, 'featured image');
            }

            return true;
        });

        return true;
    }

    /**
     * @param Post $post
     *
     * @throws \Exception
     *
     * @return mixed
     */
    public function destroy(Post $post)
    {
        if (!$post->delete()) {
            throw new GeneralException(trans('exceptions.backend.posts.delete'));
        }

        return true;
    }

    /**
     * @param array $ids
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    private function batchQuery(array $ids)
    {
        $query = $this->query()->whereIn('id', $ids);

        if (!Gate::check('manage posts')) {
            // Filter to only current user's posts
            $query->whereUserId(auth()->id());
        }

        return $query;
    }

    /**
     * @param array $ids
     *
     * @throws \Exception|\Throwable
     *
     * @return mixed
     */
    public function batchDestroy(array $ids)
    {
        DB::transaction(function () use ($ids) {
            /** @var Post[] $posts */
            $posts = $this->batchQuery($ids)->get();

            foreach ($posts as $post) {
                $this->destroy($post);
            }

            return true;
        });

        return true;
    }

    /**
     * @param array $ids
     *
     * @throws \Throwable
     * @throws \Exception
     *
     * @return mixed
     */
    public function batchPublish(array $ids)
    {
        DB::transaction(function () use ($ids) {
            $query = $this->batchQuery($ids);

            if (Gate::check('publish posts')) {
                if ($query->update(['status' => Post::PUBLISHED])) {
                    return true;
                }
            } else {
                // Set to moderation pending if no right to publish
                if ($query->update(['status' => Post::PENDING])) {
                    return true;
                }
            }

            throw new GeneralException(trans('exceptions.backend.posts.update'));
        });
    }

    /**
     * @param array $ids
     *
     * @throws \Throwable
     * @throws \Exception
     *
     * @return mixed
     */
    public function batchPin(array $ids)
    {
        DB::transaction(function () use ($ids) {
            $query = $this->batchQuery($ids);

            if ($query->update(['pinned' => true])) {
                return true;
            }

            throw new GeneralException(trans('exceptions.backend.posts.update'));
        });

        return true;
    }

    /**
     * @param array $ids
     *
     * @throws \Throwable
     * @throws \Exception
     *
     * @return mixed
     */
    public function batchPromote(array $ids)
    {
        DB::transaction(function () use ($ids) {
            $query = $this->batchQuery($ids);

            if ($query->update(['promoted' => true])) {
                return true;
            }

            throw new GeneralException(trans('exceptions.backend.posts.update'));
        });

        return true;
    }

    /**
     * @param \App\Models\Post $post
     *
     * @return string
     */
    public function getActionButtons(Post $post)
    {
        $buttons = $this->getPreviewButtonHtml('blog.show', $post->slug)
            .$this->getEditButtonHtml("#/post/{$post->id}/edit")
            .$this->getDeleteButtonHtml('admin.post.destroy', $post);

        return $buttons;
    }
}
