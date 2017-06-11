<?php

namespace App\Repositories\Contracts;

use App\Models\Redirection;

/**
 * Class EloquentRedirectionRepository.
 */
interface RedirectionRepository extends BaseRepository
{
    /**
     * @return \Illuminate\Database\Query\Builder
     */
    public function get();

    /**
     * @param $path
     *
     * @return Redirection
     */
    public function find($path);

    /**
     * @param array $input
     *
     * @return mixed
     */
    public function store(array $input);

    /**
     * @param Redirection $redirection
     * @param array       $input
     *
     * @return mixed
     */
    public function update(Redirection $redirection, array $input);

    /**
     * @param Redirection $redirection
     *
     * @return mixed
     */
    public function destroy(Redirection $redirection);

    /**
     * @param array $ids
     *
     * @return mixed
     */
    public function batchDestroy(array $ids);

    /**
     * @param array $ids
     *
     * @return mixed
     */
    public function batchEnable(array $ids);

    /**
     * @param array $ids
     *
     * @return mixed
     */
    public function batchDisable(array $ids);

    /**
     * @param \App\Models\Redirection $redirection
     *
     * @return mixed
     */
    public function getActionButtons(Redirection $redirection);
}
