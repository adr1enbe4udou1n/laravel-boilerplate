<?php

namespace App\Models\Traits;

use App\Models\Favourite;

trait Favouritable
{
    /**
     * Get is favourite.
     *
     * @return bool
     */
    public function getIsFavouriteAttribute(): bool
    {
        if (auth()->guest()) {
            return false;
        }

        return Favourite::query()->where([
            'model_type' => static::class,
            'model_id'   => $this->id,
            'user_id'    => auth()->id(),
        ])->exists();
    }
}
