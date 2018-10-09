<?php
declare(strict_types = 1);

namespace App\Repositories\Contracts;

use App\Models\Favourite;

/**
 * Interface FavouriteRepository
 */
interface FavouriteRepository extends BaseRepository
{
    /**
     * @param bool $toggle
     * @param string $modelType
     * @param int $modelId
     * @param int $userId
     */
    public function toggleFavourite(bool $toggle, string $modelType, int $modelId, int $userId);

    /**
     * @param string $modelType
     * @param int $modelId
     * @param int $userId
     * @return Favourite
     */
    public function addToFavourite(string $modelType, int $modelId, int $userId);

    /**
     * @param string $modelType
     * @param int $modelId
     * @param int $userId
     * @return bool|mixed|null
     */
    public function removeFromFavourite(string $modelType, int $modelId, int $userId);
}
