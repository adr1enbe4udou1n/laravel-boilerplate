<?php

namespace App\Models;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Meta.
 */
class Meta extends Model
{
    use Translatable;

    /**
     * The attributes that are translatable.
     *
     * @var array
     */
    public $translatedAttributes = [
        'title',
        'description',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'route',
    ];

    /**
     * The relationship that are eager loaded.
     *
     * @var array
     */
    protected $with = [
        'translations',
    ];

    protected $appends = ['can_edit', 'can_delete'];

    public function getCanEditAttribute()
    {
        return true;
    }

    public function getCanDeleteAttribute()
    {
        return Gate::check('access all backend') || Gate::check('delete metas');
    }

    public function metable()
    {
        return $this->morphTo();
    }
}
