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

    protected function saveImagesToMediaCollection(string $field)
    {
        preg_match_all('@src="([^"]+)"@', $this->$field, $match);
        $src = array_pop($match);

        if (count($src)) {
            foreach ($src as $path) {
                $startPath = '/storage/tmp/';
                if (starts_with($path, $startPath)) {
                    $file = Storage::disk('public')->path(str_replace('/storage', '', $path));
                    $media = $this->addMedia($file)
                        ->toMediaCollection('editor images');

                    $imagePath = str_replace(config('app.url'), '', $media->getUrl());
                    $this->update([
                        $field => str_replace($path, $imagePath, $this->$field),
                    ]);
                }
            }
        }
    }
}
