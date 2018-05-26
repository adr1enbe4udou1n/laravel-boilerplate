<?php

namespace App\Models\Traits;

use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

trait HasSlug
{
    private function isSlugTranslatable()
    {
        return
            method_exists($this, 'isTranslatableAttribute') &&
            $this->isTranslatableAttribute($this->sluggable);
    }

    public function scopeWhereSlug(Builder $scope, string $slug)
    {
        return $scope->where($this->isSlugTranslatable() ? "slug->{$this->getLocale()}" : 'slug', $slug);
    }

    public static function bootHasSlug()
    {
        static::saving(function (Model $model) {
            if (! $model->isSlugTranslatable()) {
                $property = $model->sluggable;
                $model->slug = $model->generateSlug($model->$property);

                return;
            }

            collect($model->getTranslatedLocales($model->sluggable))
                ->each(function (string $locale) use ($model) {
                    $model->setTranslation('slug', $locale,
                        $model->generateSlug($model->getTranslation($model->sluggable, $locale), $locale)
                    );
                });
        });
    }

    public function generateSlug($source, $locale = null, $separator = '-')
    {
        // Generate slug
        $slug = str_slug($source);

        // Query similar slugs for unicity
        $attribute = $locale ? 'slug->'.$locale : 'slug';
        $similarSlugs = $this->newQuery()
            ->where($attribute, $slug)
            ->orWhere($attribute, 'LIKE', $slug.$separator.'%')
            ->pluck($attribute, $this->getKeyName());

        // OK if no result
        if ($similarSlugs->isEmpty()) {
            return $slug;
        }
        // Return slug of existing model if similar to generated slug (updating case)
        if ($currentSlug = $similarSlugs->get($this->getKey())) {
            if (
                $currentSlug === $slug ||
                0 === mb_strpos($currentSlug, $slug)
            ) {
                return $currentSlug;
            }
        }
        $suffix = self::generateSuffix($slug, $separator, $similarSlugs);

        return $slug.$separator.$suffix;
    }

    /**
     * Generate a unique suffix for the given slug (and list of existing, "similar" slugs).
     *
     * @param string                         $slug
     * @param                                $separator
     * @param \Illuminate\Support\Collection $list
     *
     * @return string
     */
    protected static function generateSuffix($slug, $separator, Collection $list)
    {
        $len = mb_strlen($slug.$separator);
        // Return the highest suffix of collection
        $list->transform(function ($value) use ($len) {
            return (int) mb_substr($value, $len);
        });

        return $list->max() + 1;
    }
}
