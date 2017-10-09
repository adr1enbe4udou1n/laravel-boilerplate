<?php

namespace App\Repositories\Contracts;

/**
 * Interface BaseRepository.
 */
interface BaseRepository
{
    /**
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query();

    /**
     * @param      $query
     * @param null $callback
     *
     * @return \Laravel\Scout\Builder
     */
    public function search($query, $callback = null);

    /**
     * @param array $columns
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function select(array $columns = ['*']);

    /**
     * @param array $attributes
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function make(array $attributes = []);
}
