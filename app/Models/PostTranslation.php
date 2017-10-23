<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

/**
 * App\Models\ArticleTranslation.
 *
 * @property int $id
 * @property int $post_id
 * @property string $locale
 * @property string $title
 * @property string $summary
 * @property string $body
 * @property string $slug
 *
 * @method static \Illuminate\Database\Query\Builder|\App\Models\PostTranslation findSimilarSlugs(\Illuminate\Database\Eloquent\Model $model, $attribute, $config, $slug)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\PostTranslation whereArticleId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\PostTranslation whereBody($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\PostTranslation whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\PostTranslation whereLocale($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\PostTranslation whereSlug($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\PostTranslation whereSummary($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\PostTranslation whereTitle($value)
 * @mixin \Eloquent
 *
 * @method static \Illuminate\Database\Query\Builder|\App\Models\PostTranslation wherePostId($value)
 *
 * @property \App\Models\Post $post
 */
class PostTranslation extends Model
{
    use Sluggable;

    public $timestamps = false;
    protected $fillable = ['title', 'summary', 'body', 'slug'];

    /**
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title',
            ],
        ];
    }

    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
