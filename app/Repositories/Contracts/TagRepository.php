<?php

namespace App\Repositories\Contracts;

use App\Models\Tag;

/**
 * Interface TagRepository.
 */
interface TagRepository extends BaseRepository
{
    /**
     * @param string $slug
     *
     * @return mixed
     */
    public function findBySlug($slug);

    /**
     * @param string $name
     *
     * @return mixed
     */
    public function findOrCreate($name);

    /**
     * @param string $name
     *
     * @return mixed
     */
    public function delete($name);
}
