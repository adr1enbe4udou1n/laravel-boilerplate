<?php

namespace App\Models;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\Taggable;
use Plank\Mediable\Mediable;

/**
 * App\Models\Article.
 *
 * @property int                                                                         $id
 * @property int                                                                         $user_id
 * @property string                                                                      $locale
 * @property string                                                                      $title
 * @property string                                                                      $summary
 * @property string                                                                      $body
 * @property string                                                                      $slug
 * @property bool                                                                        $status
 * @property bool                                                                        $promoted
 * @property bool                                                                        $pinned
 * @property string                                                                      $published_at
 * @property \Carbon\Carbon                                                              $created_at
 * @property \Carbon\Carbon                                                              $updated_at
 * @property \Illuminate\Database\Eloquent\Collection|\App\Models\PostTranslation[] $translations
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Post listsTranslations($translationField)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Post notTranslatedIn($locale = null)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Post orWhereTranslation($key, $value, $locale = null)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Post orWhereTranslationLike($key, $value, $locale = null)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Post translated()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Post translatedIn($locale = null)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Post whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Post whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Post whereImage($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Post wherePinned($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Post wherePromoted($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Post wherePublishedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Post whereTranslation($key, $value, $locale = null)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Post whereTranslationLike($key, $value, $locale = null)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Post whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Post whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Post withTranslation()
 * @mixin \Eloquent
 * @property \Illuminate\Database\Eloquent\Collection|\App\Models\Tag[] $tags
 * @property mixed $status_label
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Post whereStatus($value)
 * @property \Illuminate\Database\Eloquent\Collection|\Plank\Mediable\Media[] $media
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Post published()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Post whereHasMedia($tags, $match_all = false)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Post whereHasMediaMatchAll($tags)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Post withMedia($tags = array(), $match_all = false)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Post withMediaMatchAll($tags = array())
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Post withTag(\App\Models\Tag $tag)
 * @property mixed $featured_image_url
 * @property \App\Models\User $owner
 */
class Post extends Model
{
    use Mediable;
    use Taggable;
    use Translatable;

    public $translatedAttributes = ['title', 'summary', 'body', 'slug'];

    protected $dates = [
        'published_at',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable
        = [
            'image',
            'published',
        ];

    protected $with = ['translations', 'media'];

    const DRAFT = 0;
    const PENDING = 1;
    const PUBLISHED = 2;

    public static function getStatuses()
    {
        return [
            self::DRAFT => 'labels.backend.posts.statuses.draft',
            self::PENDING => 'labels.backend.posts.statuses.pending',
            self::PUBLISHED => 'labels.backend.posts.statuses.published',
        ];
    }

    public function getStatusLabelAttribute()
    {
        return self::getStatuses()[$this->status];
    }

    public function getFeaturedImageUrlAttribute()
    {
        return $this->getMedia('featured image')->first()->getUrl();
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Scope a query to only include published articles.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopePublished(Builder $query)
    {
        return $query->where('status', '=', self::PUBLISHED);
    }
}
