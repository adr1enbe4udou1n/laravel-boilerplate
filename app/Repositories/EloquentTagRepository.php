<?php

namespace App\Repositories;

use App\Models\Tag;
use App\Repositories\Contracts\TagRepository;
use Illuminate\Contracts\Config\Repository;
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
     * @var \Illuminate\Contracts\Config\Repository
     */
    protected $config;

    /**
     * EloquentUserRepository constructor.
     *
     * @param Tag                                              $tag
     * @param \Mcamara\LaravelLocalization\LaravelLocalization $localization
     * @param \Illuminate\Contracts\Config\Repository          $config
     */
    public function __construct(Tag $tag, LaravelLocalization $localization, Repository $config)
    {
        parent::__construct($tag);
        $this->localization = $localization;
        $this->config = $config;
    }

    /**
     * @param string $slug
     *
     * @return mixed
     */
    public function findBySlug($slug)
    {
        // TODO: Implement findBySlug() method.
    }

    /**
     * @param string $name
     *
     * @return mixed
     */
    public function store($name)
    {
        // TODO: Implement store() method.
    }

    /**
     * @param Tag $tag
     *
     * @return mixed
     */
    public function destroy(Tag $tag)
    {
        // TODO: Implement destroy() method.
    }
}
