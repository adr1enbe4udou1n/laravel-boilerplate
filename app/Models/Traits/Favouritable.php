<?php

namespace App\Models\Traits;

use App\Models\Favourite;
use Illuminate\Database\Eloquent\Relations\HasOne;

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

    /**
     * @return mixed
     */
    public function favourite(): HasOne
    {
        return $this->hasOne(Favourite::class, 'model_id', 'id')
            ->where(['model_type' => static::class]);
    }
}
