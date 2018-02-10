<?php

namespace App\Models;

use App\Events\SluggableSaving;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Tag.
 */
class Tag extends Model
{
    /**
     * The event map for the model.
     *
     * @var array
     */
    protected $dispatchesEvents = [
        'saving' => SluggableSaving::class,
    ];

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'locale',
        'name',
    ];

    /**
     * Get all of the posts that are assigned this tag.
     */
    public function posts()
    {
        return $this->morphedByMany(Post::class, 'taggable');
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->name;
    }
}
