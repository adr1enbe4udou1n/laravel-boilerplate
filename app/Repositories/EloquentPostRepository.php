<?php

namespace App\Repositories;

use App\Models\Post;
use App\Models\PostTranslation;
use App\Models\Tag;
use App\Models\User;
use App\Repositories\Contracts\PostRepository;
use App\Repositories\Traits\HtmlActionsButtons;
use Illuminate\Contracts\Config\Repository;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Mcamara\LaravelLocalization\LaravelLocalization;

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
    public function __construct(Post $post, LaravelLocalization $localization, Repository $config)
    {
        parent::__construct($post);
        $this->localization = $localization;
        $this->config = $config;
    }

    /**
     * @param Tag $tag
     *
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
     * @internal param \App\Models\Tag $tag
     *
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
            return $postTranslation->post()->getQuery()->with(['tags' => function (MorphToMany $query) {
                $query->where('locale', '=', $this->localization->getCurrentLocale());
            }])->first();
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
     */
    public function destroy(Post $post)
    {
        // TODO: Implement destroy() method.
    }

    /**
     * @param array $ids
     *
     * @return mixed
     */
    public function batchDestroy(array $ids)
    {
        // TODO: Implement batchDestroy() method.
    }

    /**
     * @param array $ids
     *
     * @return mixed
     */
    public function batchPublish(array $ids)
    {
        // TODO: Implement batchPublish() method.
    }

    /**
     * @param array $ids
     *
     * @return mixed
     */
    public function batchPromote(array $ids)
    {
        // TODO: Implement batchPromote() method.
    }

    /**
     * @param array $ids
     *
     * @return mixed
     */
    public function batchPin(array $ids)
    {
        // TODO: Implement batchPin() method.
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
