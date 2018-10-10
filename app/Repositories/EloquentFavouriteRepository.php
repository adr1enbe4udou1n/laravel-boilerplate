<?php

namespace App\Repositories;

use App\Models\Favourite;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class EloquentFavouriteRepository extends EloquentBaseRepository
{
    /** @var Favourite */
    protected $model;

    public function __construct(Favourite $model)
    {
        parent::__construct($model);
    }

    /**
     * @param bool $toggle
     * @param string $modelType
     * @param int $modelId
     * @param int $userId
     */
    public function toggleFavourite(bool $toggle, string $modelType, int $modelId, int $userId)
    {
        if ($toggle) {
            $this->addToFavourite($modelType, $modelId, $userId);
        } else {
            $this->removeFromFavourite($modelType, $modelId, $userId);
        }
    }

    /**
     * @param string $modelType
     * @param int $modelId
     * @param int $userId
     *
     * @return Favourite
     */
    public function addToFavourite(string $modelType, int $modelId, int $userId)
    {
        /** @var Favourite $model */
        $model = $this->query()->firstOrCreate([
            'model_type' => $modelType,
            'model_id'   => $modelId,
            'user_id'    => $userId,
        ]);

        return $model;
    }

    /**
     * @param string $modelType
     * @param int $modelId
     * @param int $userId
     *
     * @return bool|mixed|null
     */
    public function removeFromFavourite(string $modelType, int $modelId, int $userId)
    {
        return $this->query()->firstOrNew([
            'model_type' => $modelType,
            'model_id'   => $modelId,
            'user_id'    => $userId,
        ])->delete();
    }

    /**
     * @param string $type
     * @param int $userId
     *
     * @return Builder
     */
    public function getUserFavouritesByType(string $type, int $userId): Builder
    {
        if (! array_key_exists($type, Favourite::EXISTING_TYPES)) {
            abort(404);
        }

        /** @var Model $model */
        $model = Favourite::EXISTING_TYPES[$type];

        return $model::with(['favourite'])
            ->join('favourites', 'favourites.model_id', 'id', 'inner')
            ->where([
                'model_type'         => $model,
                'favourites.user_id' => $userId,
            ])
            ->orderBy('favourites.created_at', 'desc');
    }
}
