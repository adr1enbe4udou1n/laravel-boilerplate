<?php

namespace App\Models\Traits;

use Illuminate\Database\Eloquent\Model;

trait HasSlug
{
    public static function bootHasSlug()
    {
        static::saving(function (Model $model) {
            if (! $model->isSlugTranslatable()) {
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

    protected function isSlugTranslatable()
    {
        return property_exists($this, 'translatable') && in_array($this->sluggable, $this->translatable, true);
    }
}
