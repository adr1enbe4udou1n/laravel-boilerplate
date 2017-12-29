<?php

namespace App\Repositories\Contracts;

use App\Models\Meta;

/**
 * Interface MetaRepository.
 */
interface MetaRepository extends BaseRepository
{
    /**
     * @param $route
     *
     * @return Meta
     */
    public function find($route);

    /**
     * @param array $input
     *
     * @return mixed
     */
    public function store(array $input);

    /**
     * @param Meta  $meta
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
     */
    public function batchDestroy(array $ids);
}
