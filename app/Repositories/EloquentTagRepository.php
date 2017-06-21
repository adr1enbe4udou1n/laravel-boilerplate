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
        return $this->query()->whereSlug($slug)->first();
    }

    /**
     * @param string $name
     *
     * @return mixed
     */
    public function findOrCreate($name)
    {
        return $this->query()->whereName($name)->firstOrCreate([
            'locale' => $this->localization->getCurrentLocale(),
            'name' => $name,
        ]);
    }

    /**
     * @param string $name
     *
     * @return bool
     * @throws \Exception
     */
    public function delete($name)
    {
        return $this->query()->whereName($name)->delete();
    }
}
