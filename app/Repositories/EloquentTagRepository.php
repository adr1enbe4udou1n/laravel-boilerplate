<?php

namespace App\Repositories;

use App\Models\Tag;
use App\Repositories\Contracts\TagRepository;
use Mcamara\LaravelLocalization\LaravelLocalization;

/**
 * Class EloquentTagRepository.
 */
class EloquentTagRepository extends EloquentBaseRepository implements TagRepository
{
    /**
     * @var \Mcamara\LaravelLocalization\LaravelLocalization
     */
    protected $localization;

    /**
     * EloquentUserRepository constructor.
     *
     * @param Tag                                              $tag
     * @param \Mcamara\LaravelLocalization\LaravelLocalization $localization
     */
    public function __construct(Tag $tag, LaravelLocalization $localization)
    {
        parent::__construct($tag);
        $this->localization = $localization;
    }

    /**
     * @param string $slug
     *
     * @return mixed
     */
    public function findBySlug($slug)
    {
        $locale = app()->getLocale();

        return $this->query()->where("slug->{$locale}", $slug)->first();
    }
}
