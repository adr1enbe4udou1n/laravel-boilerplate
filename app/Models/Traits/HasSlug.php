<?php

namespace App\Models\Traits;

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
                $model->slug = str_slug($model->$property.'-'.$model->getKey());

                return;
            }

            collect($model->getTranslatedLocales($model->sluggable))
                ->each(function (string $locale) use ($model) {
                    $model->setTranslation('slug', $locale,
                        str_slug($model->getTranslation($model->sluggable, $locale).'-'.$model->getKey())
                    );
                });
        });
    }
}
