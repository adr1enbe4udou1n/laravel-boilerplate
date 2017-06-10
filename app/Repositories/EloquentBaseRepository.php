<?php

namespace App\Repositories;

use App\Repositories\Contracts\BaseRepository;
use Illuminate\Database\Eloquent\Model;

/**
 * Class BaseRepository.
 */
class EloquentBaseRepository implements BaseRepository
{
    protected $model;

    /**
     * BaseRepository constructor.
     *
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        return $this->model->newQuery();
    }

    /**
     * @param array $attributes
     *
     * @return Model
     */
    public function make(array $attributes = [])
    {
        return $this->query()->newModelInstance($attributes);
    }
}
