<?php

namespace App\Models;

use App\Events\SluggableSaving;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\ArticleTranslation.
 */
class PostTranslation extends Model
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
        'title',
        'summary',
        'body',
        'slug',
    ];

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->title;
    }

    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
