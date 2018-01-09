<?php

namespace App\Providers;

use Collective\Html\FormFacade;
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
        FormFacade::component('bsText', 'components.form.input', ['name', 'title', 'value' => null, 'attributes' => [], 'label_cols' => null, 'description' => null, 'type' => 'text']);
        FormFacade::component('bsEmail', 'components.form.input', ['name', 'title', 'value' => null, 'attributes' => [], 'label_cols' => null, 'description' => null, 'type' => 'email']);
        FormFacade::component('bsTel', 'components.form.input', ['name', 'title', 'value' => null, 'attributes' => [], 'label_cols' => null, 'description' => null, 'type' => 'tel']);
        FormFacade::component('bsNumber', 'components.form.input', ['name', 'title', 'value' => null, 'attributes' => [], 'label_cols' => null, 'description' => null, 'type' => 'number']);
        FormFacade::component('bsDatetime', 'components.form.input', ['name', 'title', 'value' => null, 'attributes' => [], 'label_cols' => null, 'description' => null, 'type' => 'datetime']);
        FormFacade::component('bsPassword', 'components.form.input', ['name', 'title', 'attributes' => [], 'label_cols' => null, 'description' => null, 'value' => '', 'type' => 'password']);
        FormFacade::component('bsFile', 'components.form.input', ['name', 'title', 'attributes' => [], 'label_cols' => null, 'description' => null, 'value' => null, 'type' => 'file']);
        FormFacade::component('bsTextarea', 'components.form.textarea', ['name', 'title', 'value' => null, 'attributes' => [], 'label_cols' => null, 'description' => null]);
        FormFacade::component('bsSelect', 'components.form.select', ['name', 'title', 'list' => [], 'selected' => null, 'attributes' => [], 'label_cols' => null, 'description' => null]);
        FormFacade::component('bsCheckbox', 'components.form.custom-control', ['name', 'description', 'value' => null, 'type' => 'checkbox']);

        HtmlFacade::macro('asset', function ($path) {
            static $manifest;

            $basePath = app()->environment('production') ? 'dist' : 'build';

            if (! $manifest
                && file_exists($manifestPath = public_path("{$basePath}/manifest.json"))
            ) {
                $manifest = json_decode(file_get_contents($manifestPath), true);
            }

            if ($manifest && isset($manifest[$path])) {
                return $manifest[$path];
            }
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
