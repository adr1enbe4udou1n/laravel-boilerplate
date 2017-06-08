<?php

namespace App\Repositories\Contracts;

use App\Models\Meta;

/**
 * Class EloquentMetaRepository.
 */
interface MetaRepository
{
    /**
     * @return \Illuminate\Database\Query\Builder
     */
    public function get();

    /**
     * @param $locale
     * @param $route
     *
     * @return Meta
     */
    public function find($locale, $route);

    /**
     * @param array $input
     *
     * @return mixed
     */
    public function store(array $input);

    /**
     * @param Meta $meta
     * @param array $input
     *
     * @return mixed
     */
    public function update(Meta $meta, array $input);

    /**
     * @param Meta $meta
     *
     * @return mixed
     */
    public function destroy(Meta $meta);

    /**
     * @param array $ids
     *
     * @return mixed
     *
     */
    public function batchDestroy(array $ids);

    /**
     * @param \App\Models\Meta $meta
     *
     * @return mixed
     */
    public function getActionButtons(Meta $meta);
}
