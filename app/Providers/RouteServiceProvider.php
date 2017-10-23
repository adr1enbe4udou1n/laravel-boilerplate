<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

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

        Route::middleware(['web', 'metas', 'locale', 'localize'])
            ->prefix(LaravelLocalization::setLocale())
            ->namespace($this->namespace.'\Frontend')
            ->group(base_path('routes/public.php'));

        Route::middleware(['web', 'locale'])
            ->prefix(LaravelLocalization::setLocale())
            ->namespace($this->namespace)
            ->group(base_path('routes/auth.php'));

        Route::middleware(['web', 'locale', 'auth', 'can:access backend'])
            ->prefix(LaravelLocalization::setLocale().'/'.config('app.admin_path'))
            ->namespace($this->namespace.'\Backend')
            ->as('admin.')
            ->group(base_path('routes/admin.php'));
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
