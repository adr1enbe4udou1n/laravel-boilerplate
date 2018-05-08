<?php

namespace App\Models\Traits;

use Illuminate\Database\Eloquent\Model;

trait HasSlug
{
    public static function bootHasSlug()
    {
        static::saving(function (Model $model) {
            if (! method_exists($model, 'isTranslatableAttribute') ||
                ! $model->isTranslatableAttribute($model->sluggable)) {
                $property = $model->sluggable;
                $model->slug = str_slug($model->$property);

                return;
            }

            collect($model->getTranslatedLocales($model->sluggable))
                ->each(function (string $locale) use ($model) {
                    $model->setTranslation('slug', $locale,
                        str_slug($model->getTranslation($model->sluggable, $locale))
                    );
                });
        });
    }
}
