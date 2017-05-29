<?php

namespace App\Providers;

use Carbon\Carbon;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\URL;

class RouteServiceProvider extends ServiceProvider
{

    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     */
    public function boot()
    {
        parent::boot();

        if (config('app.force_ssl')) {
            // Force SSL (useful for production)
            URL::forceScheme('https');
        }

        if (config('app.force_app_url')) {
            // Force Route URL (useful for multi-device development)
            URL::forceRootUrl(config('app.url'));
        }

        /*
         * Set correct locale after LaravelLocalization middleware registration
         */
        $this->setLocale();
    }

    /**
     * Define default locale
     */
    private function setLocale()
    {
        $supportedLocales = \LaravelLocalization::getSupportedLocales();
        $currentLocale = \LaravelLocalization::getCurrentLocale();

        $localeRegional = $supportedLocales[$currentLocale]['regional'];
        $localeWin = $supportedLocales[$currentLocale]['locale_win'];

        /*
         * setLocale for php. Enables localized dates, format numbers, etc.
         */
        setlocale(LC_ALL,
            $localeRegional,
            "${localeRegional}.utf-8",
            "${localeRegional}.iso-8859-1",
            $localeWin
        );

        /*
         * setLocale to use Carbon source locales. Enables diffForHumans() localized
         */
        Carbon::setLocale($currentLocale);

        /*
         * Set Captcha locale
         */
        app('config')->set('no-captcha.lang', $currentLocale);
    }

    /**
     * Define the routes for the application.
     */
    public function map()
    {
        $this->mapApiRoutes();
        $this->mapWebRoutes();
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     */
    protected function mapWebRoutes()
    {
        Route::middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/web.php'));
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     */
    protected function mapApiRoutes()
    {
        Route::prefix('api')
            ->middleware('api')
            ->namespace($this->namespace)
            ->group(base_path('routes/api.php'));
    }
}
