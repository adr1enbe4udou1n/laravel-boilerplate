<?php

namespace App\Models\Traits;

use App\Models\Meta;

/**
 * Trait Metable.
 */
trait Metable
{
    /**
     * Get the meta for the model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphOne|Meta
     */
    public function meta()
    {
        return $this->morphOne(Meta::class, 'metable');
    }
}
