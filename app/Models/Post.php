<?php

namespace App\Models;

use Carbon\Carbon;
use Plank\Mediable\Media;
use Plank\Mediable\Mediable;
use Laravel\Scout\Searchable;
use App\Models\Traits\Metable;
use App\Models\Traits\Taggable;
use Illuminate\Support\Facades\Gate;
use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Stevebauman\Purify\Facades\Purify;

/**
 * App\Models\Post.
 */
class Post extends Model
{
    use Searchable;
    use Mediable;
    use Taggable;
    use Metable;
    use Translatable;

    public $asYouType = true;

    /**
     * The attributes that are translatable.
     *
     * @var array
     */
    public $translatedAttributes = [
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
        'featured_image_path',
        'thumbnail_image_path',
        'can_edit',
        'can_delete',
    ];

    /**
     * The attributes that are eager loaded.
     *
     * @var array
     */
    protected $casts = [
        'pinned' => 'boolean',
        'promoted' => 'boolean',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'status',
        'published_at',
        'unpublished_at',
        'pinned',
        'promoted',
    ];

    protected $with = [
        'tags',
        'translations',
        'media',
        'owner',
        'meta',
    ];

    public function getBodyAttribute($body)
    {
        return Purify::clean($body);
    }

    public function getCanEditAttribute()
    {
        return true;
    }

    public function getCanDeleteAttribute()
    {
        return Gate::check('access all backend') || Gate::check('delete', $this);
    }

    protected static function boot()
    {
        parent::boot();

        static::deleted(function (Post $post) {
            $post->meta->delete();
        });
    }

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

    public static function getStates()
    {
        return [
            self::DRAFT => 'danger',
            self::PENDING => 'warning',
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

    public function getFeaturedImagePathAttribute()
    {
        /** @var Media $media */
        if ($media = $this->getMedia('featured image')->first()) {
            return $media->getDiskPath();
        }

        return 'placeholder.png';
    }

    public function getThumbnailImagePathAttribute()
    {
        return image_template_url('small', $this->featured_image_path);
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
        if (is_string($value)) {
            $this->attributes['published_at'] = Carbon::createFromFormat('Y-m-d H:i', $value);
        } else {
            $this->attributes['published_at'] = $value;
        }
    }

    public function setUnPublishedAtAttribute($value)
    {
        if (is_string($value)) {
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
     * Delete media physically.
     *
     * @throws \Exception
     */
    public function handleMediableDeletion()
    {
        $this->getMedia('featured image')->each(function (Media $media) {
            $media->delete();
        });
    }

    /**
     * Get the indexable data array for the model.
     *
     * @return array
     */
    public function toSearchableArray()
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'summary' => $this->description,
            'body' => $this->body,
        ];
    }
}
