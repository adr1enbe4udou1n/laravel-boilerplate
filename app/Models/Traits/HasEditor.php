<?php

namespace App\Models\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Spatie\MediaLibrary\HasMedia\HasMedia;

trait HasEditor
{
    public static function bootHasEditor()
    {
        static::saved(function (Model $model) {
            if ($model instanceof HasMedia && property_exists($model, 'editorFields')) {
                foreach ($model->editorFields as $field) {
                    $model->saveImagesToMediaCollection($field);
                }
            }
        });
    }

    protected function parseTextForImages(string $text)
    {
        $updated = false;
        preg_match_all('@src="([^"]+)"@', $text, $match);
        $src = collect(array_pop($match))->unique();

        foreach ($src as $path) {
            $startPath = '/storage/tmp/';
            if (starts_with($path, $startPath)) {
                $file = Storage::disk('public')->path(str_replace('/storage', '', $path));
                $media = $this->addMedia($file)
                    ->toMediaCollection($this->editorCollectionName);

                $imagePath = str_replace(config('app.url'), '', $media->getUrl());
                $text = str_replace($path, $imagePath, $text);
                $updated = true;
            }
        }

        return $updated ? $text : false;
    }

    protected function saveImagesToMediaCollection(string $field)
    {
        $updated = false;
        if (method_exists($this, 'isTranslatableAttribute') &&
            $this->isTranslatableAttribute($field)) {
            foreach ($this->getTranslations($field) as $locale => $text) {
                if ($text = $this->parseTextForImages($text)) {
                    $this->setTranslation($field, $locale, $text);
                    $updated = true;
                }
            }
        }

        if ($updated) {
            $this->save();
        }
    }
}
