<?php

namespace App\Models\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

trait HasTranslatableSlug
{
    public function scopeWhereSlug(Builder $scope, string $slug)
    {
        return $scope->where("slug->{$this->getLocale()}", $slug);
    }

    public static function bootHasTranslatableSlug()
    {
        static::saving(function (Model $model) {
            collect($model->getTranslatedLocales($model->sluggable))
                ->each(function (string $locale) use ($model) {
                    $model->setTranslation('slug', $locale,
                        $model->generateSlug($model->getTranslation($model->sluggable, $locale), $locale)
                    );
                });
        });
    }

    public function generateSlug($source, $locale = null)
    {
        // Generate slug
        $slug = str_slug($source);

        // Check if existing for current locale
        $existingSlug = (bool) $this->where("slug->$locale", $slug)
            ->where($this->getKeyName(), '!=', $this->getKey())
            ->withoutGlobalScopes()
            ->first();

        // Add unique key if existing slug
        if ($existingSlug) {
            return "$slug-{$this->getKey()}";
        }

        return $slug;
    }
}
