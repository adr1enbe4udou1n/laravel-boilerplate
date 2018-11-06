<?php

namespace App\Models;

use Carbon\Carbon;
use Spatie\Tags\HasTags;
use Laravel\Scout\Searchable;
use App\Models\Traits\Metable;
use App\Models\Traits\HasEditor;
use Illuminate\Support\Facades\Gate;
use Spatie\MediaLibrary\Models\Media;
use Stevebauman\Purify\Facades\Purify;
use App\Models\Traits\TranslatableJson;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Traits\HasTranslatableSlug;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

/**
 * App\Models\Post.
 *
 * @property int                                                        $id
 * @property int|null                                                   $user_id
 * @property int                                                        $status
 * @property bool                                                       $promoted
 * @property bool                                                       $pinned
 * @property array                                                      $title
 * @property array                                                      $summary
 * @property array                                                      $body
 * @property array                                                      $slug
 * @property \Carbon\Carbon|null                                        $published_at
 * @property \Carbon\Carbon|null                                        $unpublished_at
 * @property \Carbon\Carbon|null                                        $created_at
 * @property \Carbon\Carbon|null                                        $updated_at
 * @property mixed                                                      $can_delete
 * @property mixed                                                      $can_edit
 * @property mixed                                                      $has_featured_image
 * @property mixed                                                      $featured_image_url
 * @property mixed                                                      $meta_description
 * @property mixed                                                      $meta_title
 * @property mixed                                                      $published
 * @property mixed                                                      $state
 * @property mixed                                                      $status_label
 * @property \App\Models\Meta                                           $meta
 * @property \App\Models\User|null                                      $owner
 * @property \Illuminate\Database\Eloquent\Collection|\App\Models\Tag[] $tags
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Post published()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Post whereBody($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Post whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Post whereHasMedia($tags, $match_all = false)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Post whereHasMediaMatchAll($tags)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Post whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Post wherePinned($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Post wherePromoted($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Post wherePublishedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Post whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Post whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Post whereSummary($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Post whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Post whereUnpublishedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Post whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Post whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Post withMedia($tags = array(), $match_all = false)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Post withMediaMatchAll($tags = array())
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Post withOwner(\App\Models\User $user)
 * @mixin \Eloquent
 */
class Post extends Model implements HasMedia
{
    use Searchable;
    use Metable;
    use HasTags;
    use HasTranslations;
    use HasTranslatableSlug;
    use HasMediaTrait;
    use HasEditor;

    public $sluggable = 'title';

    public $editorFields = [
        'body',
    ];

    public $editorCollectionName = 'editor images';

    public $asYouType = true;

    /**
     * The attributes that are translatable.
     *
     * @var array
     */
    public $translatable = [
        'title',
        'summary',
        'body',
        'slug',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'published_at',
        'unpublished_at',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'state',
        'status_label',
        'has_featured_image',
        'featured_image_url',
        'can_edit',
        'can_delete',
    ];

    /**
     * The attributes that are eager loaded.
     *
     * @var array
     */
    protected $casts = [
        'status'             => 'integer',
        'pinned'             => 'boolean',
        'promoted'           => 'boolean',
        'has_featured_image' => 'boolean',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'status',
        'title',
        'summary',
        'body',
        'slug',
        'published_at',
        'unpublished_at',
        'pinned',
        'promoted',
    ];

    protected $with = [
        'tags',
        'media',
        'owner',
        'meta',
    ];

    public function getCanEditAttribute()
    {
        return true;
    }

    public function getCanDeleteAttribute()
    {
        return Gate::check('delete', $this);
    }

    protected static function boot()
    {
        parent::boot();

        static::deleted(function (self $post) {
            $post->meta->delete();
        });
    }

    const DRAFT = 0;
    const PENDING = 1;
    const PUBLISHED = 2;

    public static function getStatuses()
    {
        return [
            self::DRAFT     => 'labels.backend.posts.statuses.draft',
            self::PENDING   => 'labels.backend.posts.statuses.pending',
            self::PUBLISHED => 'labels.backend.posts.statuses.published',
        ];
    }

    public static function getStates()
    {
        return [
            self::DRAFT     => 'danger',
            self::PENDING   => 'warning',
            self::PUBLISHED => 'success',
        ];
    }

    public function getStatusLabelAttribute()
    {
        return self::getStatuses()[$this->status];
    }

    public function getStateAttribute()
    {
        return self::getStates()[$this->status];
    }

    public function getPublishedAttribute()
    {
        return self::PUBLISHED === $this->status;
    }

    public function getHasFeaturedImageAttribute()
    {
        /* @var Media $media */
        return (bool) $this->getFirstMedia('featured image');
    }

    public function getFeaturedImageUrlAttribute()
    {
        if ($image = $this->getFirstMedia('featured image')) {
            return $image->getUrl();
        }
    }

    public function getMetaTitleAttribute()
    {
        return null !== $this->meta && ! empty($this->meta->title) ? $this->meta->title : $this->title;
    }

    public function getMetaDescriptionAttribute()
    {
        return null !== $this->meta && ! empty($this->meta->description) ? $this->meta->description : $this->summary;
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function setPublishedAtAttribute($value)
    {
        if (\is_string($value)) {
            $this->attributes['published_at'] = Carbon::createFromFormat('Y-m-d H:i', $value);
        } else {
            $this->attributes['published_at'] = $value;
        }
    }

    public function setUnpublishedAtAttribute($value)
    {
        if (\is_string($value)) {
            $this->attributes['unpublished_at'] = Carbon::createFromFormat('Y-m-d H:i', $value);
        } else {
            $this->attributes['unpublished_at'] = $value;
        }
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

    /**
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param \App\Models\User                      $user
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeWithOwner(Builder $query, User $user)
    {
        return $query->where('user_id', '=', $user->id);
    }

    /**
     * Get the indexable data array for the model.
     *
     * @return array
     */
    public function toSearchableArray()
    {
        return [
            'id'      => $this->id,
            'title'   => $this->title,
            'summary' => $this->summary,
            'body'    => $this->body,
        ];
    }

    public function toArray()
    {
        $attributes = parent::toArray();

        TranslatableJson::getLocalizedTranslatableAttributes($this, $attributes);

        $attributes['body'] = Purify::clean($attributes['body']);
        $attributes['tags'] = $this->tags->pluck('name');

        return $attributes;
    }
}
