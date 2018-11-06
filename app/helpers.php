<?php

use Illuminate\Database\Eloquent\Model;
use League\Glide\Urls\UrlBuilderFactory;

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
    function image_template_url($path, array $params)
    {
        $urlBuilder = UrlBuilderFactory::create('/img/', config('glide.key'));

        return $urlBuilder->getUrl($path, $params);
    }
}

if (! function_exists('localize_url')) {
    function localize_url($locale = null, $attributes = [], Model $translatable = null)
    {
        $url = null;

        if ($translatable && method_exists($translatable, 'getTranslation')) {
            /** @var \Spatie\Translatable\HasTranslations $translatable */
            if ($slug = $translatable->getTranslation('slug', $locale)) {
                $url = route(Route::current()->getName(), ['post' => $slug]);
            } else {
                $url = route('home');
            }
        }

        return LaravelLocalization::getLocalizedURL($locale, $url, $attributes, true);
    }
}
