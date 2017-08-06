<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
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
     * Register the application services.
     */
    public function register()
    {
    }
}
