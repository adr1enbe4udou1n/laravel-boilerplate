<?php

namespace App\Providers;

use Collective\Html\FormFacade as Form;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class FormServiceProvider extends ServiceProvider
{

    /**
     * Bootstrap the application services.
     *
     * @return void
     * @throws \Throwable
     */
    public function boot()
    {
        View::composer('components.form.*', function (\Illuminate\View\View $view) {
            $data = $view->getData();

            $attributes = [];
            $parameters = $data['parameters'];

            $parameters = array_merge(['name' => $data['name']], $parameters);

            switch ($view->name()) {
                case 'components.form.text':
                    if (!isset($parameters['type'])) {
                        $parameters['type'] = 'text';
                    }
                    break;
                case 'components.form.select':
                    if (!isset($parameters['type'])) {
                        $parameters['type'] = 'select';
                    }
                    break;
            }

            if (isset($parameters['required']) && $parameters['required']) {
                $attributes['required'] = true;
            }

            if (isset($parameters['placeholder'])) {
                $attributes['placeholder'] = $parameters['placeholder'];
            }
            elseif (isset($parameters['title'])) {
                $attributes['placeholder'] = $parameters['title'];
            }

            if (isset($parameters['attributes'])) {
                $attributes = array_merge($attributes, $parameters['attributes']);
            }

            $parameters['attributes'] = $attributes;

            $view->with($parameters)->withParameters($parameters);
        });

        Form::component('bsText', 'components.form.text', ['name', 'parameters' => []]);
        Form::component('bsPassword', 'components.form.password', ['name', 'parameters' => []]);
        Form::component('bsTextarea', 'components.form.textarea', ['name', 'parameters' => []]);
        Form::component('bsSelect', 'components.form.select', ['name', 'parameters' => []]);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
