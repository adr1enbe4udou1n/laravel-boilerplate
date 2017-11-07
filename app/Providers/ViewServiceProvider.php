<?php

namespace App\Providers;

use Collective\Html\HtmlFacade;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        HtmlFacade::macro('asset', function ($path) {
            static $manifest;

            if (! starts_with($path, '/')) {
                $path = "/{$path}";
            }

            if (app()->environment('local', 'testing')) {
                if (file_exists(public_path('/hot'))) {
                    $hmrHost = config('app.hmr_host');
                    $hmrPost = config('app.hmr_port');

                    return "//{$hmrHost}:{$hmrPost}{$path}";
                }

                if (file_exists(public_path($path))) {
                    return $path;
                }
            }

            if (! $manifest
                && file_exists($manifestPath = public_path('/manifest.json'))
            ) {
                $manifest = json_decode(file_get_contents($manifestPath), true);
            }

            if ($manifest) {
                $name = basename($path);

                if (isset($manifest[$name])) {
                    return "/{$manifest[$name]}";
                }
            }

            return $path;
        });

        /*
         * Prepare flash message for alerts
         */
        View::composer('partials/messages', function (\Illuminate\View\View $view) {
            $data = collect($view->getData());

            if ($flash = session()->get('flash_message') ?: $data->get('flashMessage')) {
                $view->with('flashMessage', $flash);
                $view->with('flashType', 'info');
            } elseif ($flash = session()->get('flash_success') ?: $data->get('flashSuccess')) {
                $view->with('flashMessage', $flash);
                $view->with('flashType', 'success');
            } elseif ($flash = session()->get('flash_info') ?: $data->get('flashInfo')) {
                $view->with('flashMessage', $flash);
                $view->with('flashType', 'info');
            } elseif ($flash = session()->get('flash_warning') ?: $data->get('flashWarning')) {
                $view->with('flashMessage', $flash);
                $view->with('flashType', 'warning');
            } elseif ($flash = session()->get('flash_danger') ?: $data->get('flashDanger')) {
                $view->with('flashMessage', $flash);
                $view->with('flashType', 'danger');
            } elseif ($flash = session()->get('flash_error') ?: $data->get('flashError')) {
                $view->with('flashMessage', $flash);
                $view->with('flashType', 'danger');
            }
        });

        View::composer('*', function (\Illuminate\View\View $view) {
            $view->with('loggedInUser', auth()->user());
        });
    }

    /**
     * Register the application services.
     */
    public function register()
    {
    }
}
