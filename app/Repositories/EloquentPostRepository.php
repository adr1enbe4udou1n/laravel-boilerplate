<?php

namespace App\Repositories;

use App\Exceptions\GeneralException;
use App\Models\Post;
use App\Models\PostTranslation;
use App\Models\Tag;
use App\Models\User;
use App\Repositories\Contracts\PostRepository;
use App\Repositories\Traits\HtmlActionsButtons;
use Illuminate\Contracts\Config\Repository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Mcamara\LaravelLocalization\LaravelLocalization;

/**
 * Class EloquentPostRepository.
 */
class EloquentPostRepository extends EloquentBaseRepository implements
    PostRepository
{

    use HtmlActionsButtons;

    /**
     * @var \Mcamara\LaravelLocalization\LaravelLocalization
     */
    protected $localization;

    /**
     * @var \Illuminate\Contracts\Config\Repository
     */
    protected $config;

    /**
     * EloquentUserRepository constructor.
     *
     * @param Post                                             $post
     * @param \Mcamara\LaravelLocalization\LaravelLocalization $localization
     * @param \Illuminate\Contracts\Config\Repository          $config
     */
    public function __construct(
        Post $post,
        LaravelLocalization $localization,
        Repository $config
    ) {
        parent::__construct($post);
        $this->localization = $localization;
        $this->config = $config;
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
     * @param array $input
     *
     * @return mixed
     */
    public function store(array $input)
    {
        // TODO: Implement store() method.
    }

    /**
     * @param Post  $post
     * @param array $input
     *
     * @return mixed
     */
    public function update(Post $post, array $input)
    {
        // TODO: Implement update() method.
    }

    /**
     * @param Post $post
     *
     * @return mixed
     * @throws \Exception
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
    private function batchQuery(array $ids) {
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
     * @return mixed
     * @throws \Exception|\Throwable
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
     * @return mixed
     * @throws \Throwable
     * @throws \Exception
     */
    public function batchPublish(array $ids)
    {
        DB::transaction(function () use ($ids) {
            $query = $this->batchQuery($ids);

            if (Gate::check('publish posts')) {
                if ($query->update(['status' => Post::PUBLISHED])) {
                    return true;
                }
            }
            else {
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
     * @return mixed
     * @throws \Throwable
     * @throws \Exception
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
     * @return mixed
     * @throws \Throwable
     * @throws \Exception
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
        $buttons = $this->getEditButtonHtml('admin.post.edit', $post)
            .$this->getDeleteButtonHtml('admin.post.destroy', $post);

        return $buttons;
    }
}
