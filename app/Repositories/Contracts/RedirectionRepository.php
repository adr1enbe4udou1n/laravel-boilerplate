<?php

namespace App\Repositories\Contracts;

use App\Models\Redirection;

/**
 * Interface RedirectionRepository.
 */
interface RedirectionRepository extends BaseRepository
{
    /**
     * @param $source
     *
     * @return Redirection
     */
    public function find($source);

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
}
