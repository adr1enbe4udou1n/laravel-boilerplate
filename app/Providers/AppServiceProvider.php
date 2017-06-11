<?php

namespace App\Providers;

use App\Models\Meta;
use App\Repositories\Contracts\FormSettingRepository;
use App\Repositories\Contracts\FormSubmissionRepository;
use App\Repositories\Contracts\MetaRepository;
use App\Repositories\Contracts\RoleRepository;
use App\Repositories\Contracts\UserRepository;
use App\Repositories\EloquentFormSettingRepository;
use App\Repositories\EloquentFormSubmissionRepository;
use App\Repositories\EloquentMetaRepository;
use App\Repositories\EloquentRoleRepository;
use App\Repositories\EloquentUserRepository;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Laravel\Dusk\DuskServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * @var \Illuminate\Support\Collection
     */
    protected static $aliases;

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        /*
         * Load URL aliases
         */
        $this->loadAliases();

        /*
         * Share hot mode for views
         */
        View::composer('*', function (\Illuminate\View\View $view) {
            $view->with('hmr', file_exists(public_path('/hot')));
        });

        /*
         * Prepare flash message for alerts
         */
        View::composer('partials/messages', function (\Illuminate\View\View $view) {
            $data = collect($view->getData());

            if ($flash = session()->get('flash_message') ?: $data->get('flash_message')) {
                $view->with('flash_message', $flash);
                $view->with('flash_type', 'info');
            } elseif ($flash = session()->get('flash_success') ?: $data->get('flash_success')) {
                $view->with('flash_message', $flash);
                $view->with('flash_type', 'success');
            } elseif ($flash = session()->get('flash_info') ?: $data->get('flash_info')) {
                $view->with('flash_message', $flash);
                $view->with('flash_type', 'info');
            } elseif ($flash = session()->get('flash_warning') ?: $data->get('flash_warning')) {
                $view->with('flash_message', $flash);
                $view->with('flash_type', 'warning');
            } elseif ($flash = session()->get('flash_danger') ?: $data->get('flash_danger')) {
                $view->with('flash_message', $flash);
                $view->with('flash_type', 'danger');
            } elseif ($flash = session()->get('flash_error') ?: $data->get('flash_error')) {
                $view->with('flash_message', $flash);
                $view->with('flash_type', 'danger');
            }
        });

        View::composer('*', function (\Illuminate\View\View $view) {
            $view->with('logged_in_user', $logged_in_user = auth()->user());
        });
    }

    /**
     * Load URL Aliases cached statically by request
     */
    private function loadAliases()
    {
        $metas = $this->app->make(MetaRepository::class);

        self::$aliases = $metas->query()->get(['locale', 'route', 'url']);
    }

    /**
     * @param $locale
     * @param $name
     *
     * @return string
     */
    public static function getAliasUrl($locale, $name)
    {
        /** @var Meta $meta */
        $meta = self::$aliases->first(function (Meta $item) use ($locale, $name) {
            return $item->locale === $locale && $item->route === $name;
        });

        if ($meta) {
            return $meta->url;
        }
        return null;
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

        $this->app->bind(
            RoleRepository::class,
            EloquentRoleRepository::class
        );

        $this->app->bind(
            MetaRepository::class,
            EloquentMetaRepository::class
        );

        $this->app->bind(
            FormSettingRepository::class,
            EloquentFormSettingRepository::class
        );

        $this->app->bind(
            FormSubmissionRepository::class,
            EloquentFormSubmissionRepository::class
        );
    }
}
