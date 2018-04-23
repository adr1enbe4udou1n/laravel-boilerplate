<?php

namespace App\Models\Traits;

trait TranslatableJson
{
    public static function getLocalizedTranslatableAttributes($model, &$attributes)
    {
        foreach ($model->getTranslatableAttributes() as $name) {
            $attributes[$name] = $model->getTranslation($name, app()->getLocale());
        }
    }

    public function toArray()
    {
        $attributes = parent::toArray();

        self::getLocalizedTranslatableAttributes($this, $attributes);

        return $attributes;
    }
}
