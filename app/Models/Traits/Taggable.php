<?php

namespace App\Models\Traits;

use App\Models\Tag;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

/**
 * Trait Taggable.
 */
trait Taggable
{
    /**
     * Filter Tags to current locale.
     *
     * @return \Closure
     * @throws \InvalidArgumentException
     */
    public static function applyLocaleTags()
    {
        return function(Builder $builder) {
            $builder->with([
                'tags' => function (MorphToMany $query) {
                    $query->where('locale', '=',
                        LaravelLocalization::getCurrentLocale());
                }
            ]);
        };
    }

    /**
     * Get all of the tags for the post.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany|Tag[]
     */
    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

    /**
     * Scope a query to only include elements with specific tag.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param \App\Models\Tag                       $tag
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeWithTag(Builder $query, Tag $tag)
    {
        return $query->whereHas('tags', function (Builder $query) use ($tag) {
            return $query->where('tags.id', '=', $tag->id);
        });
    }
}
