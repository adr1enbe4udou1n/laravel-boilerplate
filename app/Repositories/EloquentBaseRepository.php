<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use App\Repositories\Contracts\BaseRepository;

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
     * @param      $query
     * @param null $callback
     *
     * @return \Laravel\Scout\Builder
     */
    public function search($query, $callback = null)
    {
        return $this->model->search($query, $callback);
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
