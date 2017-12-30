<?php

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Support\MessageBag;

if (! function_exists('is_invalid')) {
    /**
     * @param $name
     * @param $class
     *
     * @return string
     */
    function is_invalid($name, $class = 'is-invalid')
    {
        /** @var MessageBag $errors */
        $errors = session()->get('errors', new Illuminate\Support\MessageBag());

        return $errors->has($name) ? $class : '';
    }
}

if (! function_exists('home_route')) {
    /**
     * Return the route to the "home" page depending on authentication/authorization status.
     *
     * @return string
     */
    function home_route()
    {
        if (Gate::allows('access backend')) {
            return route('admin.home');
        }

        return route('user.home');
    }
}

if (! function_exists('is_admin_route')) {
    /**
     * @param \Illuminate\Http\Request $request
     *
     * @return bool
     */
    function is_admin_route(Illuminate\Http\Request $request)
    {
        $action = $request->route()->getAction();

        return 'App\Http\Controllers\Backend' === $action['namespace'];
    }
}

if (! function_exists('image_template_url')) {
    /**
     * @param $template
     * @param $image_path
     *
     * @return string
     */
    function image_template_url($template, $image_path)
    {
        return url(config('imagecache.route')."/$template/$image_path");
    }
}

if (! function_exists('localize_url')) {
    function localize_url($locale = null, $attributes = [], Model $translatable = null)
    {
        $url = null;

        if ($translatable && method_exists($translatable, 'translate')) {
            /** @var Translatable $translatable */
            if ($translation = $translatable->translate($locale)) {
                $slug = $translation->slug;

                $url = route(Route::current()->getName(), ['post' => $slug]);
            } else {
                $url = route('home');
            }
        }

        return LaravelLocalization::getLocalizedURL($locale, $url, $attributes, true);
    }
}
