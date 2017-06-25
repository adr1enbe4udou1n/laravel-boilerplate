<?php

namespace App\Repositories;

use App\Repositories\Contracts\BaseRepository;
use Illuminate\Database\Eloquent\Model;

/**
 * Class EloquentBaseRepository.
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
     * @param array $columns
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function select(array $columns = ['*'])
    {
        return $this->query()->select($columns);
    }

    /**
     * @param array $attributes
     *
     * @return Model
     */
    public function make(array $attributes = [])
    {
        return $this->query()->make($attributes);
    }
}
