<?php

namespace App\Providers;

use App\Repositories\Contracts\UserRepository;
use App\Repositories\EloquentUserRepository;
use Carbon\Carbon;
use function foo\func;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Laravel\Dusk\DuskServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        /*
         * setLocale for php. Enables ->formatLocalized() with localized values for dates
         */
        setlocale(LC_TIME, config('app.locale_php'));
        /*
         * setLocale to use Carbon source locales. Enables diffForHumans() localized
         */
        Carbon::setLocale(config('app.locale'));

        if ($this->app->environment() === 'production') {
            // Force SSL in production
            URL::forceScheme('https');
        }

        View::share('hmr', file_exists(public_path('/hot')));

        View::composer('partials/messages', function (\Illuminate\View\View $view) {
            $data = collect($view->getData());

            if ($flash = session()->get('flash_message') ?: $data->get('flash_message')) {
                $view->with('flash_message', $flash);
                $view->with('flash_type', 'info');
            }
            else if ($flash = session()->get('flash_success') ?: $data->get('flash_success')) {
                $view->with('flash_message', $flash);
                $view->with('flash_type', 'info');
            }
            else if ($flash = session()->get('flash_info') ?: $data->get('flash_info')) {
                $view->with('flash_message', $flash);
                $view->with('flash_type', 'info');
            }
            else if ($flash = session()->get('flash_warning') ?: $data->get('flash_warning')) {
                $view->with('flash_message', $flash);
                $view->with('flash_type', 'warning');
            }
            else if ($flash = session()->get('flash_danger') ?: $data->get('flash_danger')) {
                $view->with('flash_message', $flash);
                $view->with('flash_type', 'danger');
            }
            else if ($flash = session()->get('flash_error') ?: $data->get('flash_error')) {
                $view->with('flash_message', $flash);
                $view->with('flash_type', 'danger');
            }
        });
    }

    /**
     * Register any application services.
     */
    public function register()
    {
        if ($this->app->environment('local', 'testing')) {
            $this->app->register(\Barryvdh\Debugbar\ServiceProvider::class);
            $this->app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);
            $this->app->register(DuskServiceProvider::class);
        }

        $this->app->bind(
            UserRepository::class,
            EloquentUserRepository::class
        );
    }
}
