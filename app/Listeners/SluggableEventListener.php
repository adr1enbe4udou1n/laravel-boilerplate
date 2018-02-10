<?php

namespace App\Listeners;

use App\Events\SluggableSaving;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;

class SluggableEventListener
{
    /**
     * @param \App\Events\SluggableSaving $event
     */
    public function handle(SluggableSaving $event)
    {
        $event->model->slug = $this->generateSlug($event->model);
    }

    public static function generateSlug(Model $model, $separator = '-')
    {
        // Generate slug
        $slug = str_slug($model);

        // Query similar slugs for unicity
        $similarSlugs = $model->newQuery()
            ->where('slug', $slug)
            ->orWhere('slug', 'LIKE', $slug.$separator.'%')
            ->pluck('slug', $model->getKeyName());

        // OK if no result
        if ($similarSlugs->isEmpty()) {
            return $slug;
        }

        // Return slug of existing model if similar to generated slug (updating case)
        if ($currentSlug = $similarSlugs->get($model->getKey())) {
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
     * Generate a unique suffix for the given slug (and list of existing, "similar" slugs.
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
