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
     * @throws \Throwable
     */
    public function boot()
    {
        View::composer('components.form.*', function (\Illuminate\View\View $view) {
            $data = $view->getData();

            $attributes = [
                'id' => $data['name'],
                'class' => 'form-control'
            ];
            $rules = [];
            $parameters = $data['parameters'];

            $parameters = array_merge(['name' => $data['name']], $parameters);

            switch ($view->name()) {
                case 'components.form.input':
                    if (!isset($parameters['type'])) {
                        $parameters['type'] = 'text';
                    }

                    switch ($parameters['type']) {
                        case 'email':
                            $rules[] = 'email';
                            break;
                    }
                    break;
                case 'components.form.select':
                    if (isset($parameters['multiple']) && $parameters['multiple']) {
                        $attributes['multiple'] = true;
                    }
                    break;
            }

            if (isset($parameters['required']) && $parameters['required']) {
                $attributes['required'] = true;
                $rules[] = 'required';
            }

            if (!empty($rules)) {
                $attributes['v-validate'] = "'".implode('|', $rules)."'";
                $attributes[':class'] = "{'is-invalid': errors.has('{$data['name']}') }";
            }

            if (($errors = session('errors')) && $errors->has($data['name'])) {
                $attributes['class'] .= ' is-invalid';
            }

            if (isset($parameters['strength_meter']) && $parameters['strength_meter']) {
                $attributes['data-toggle'] = 'password-strength-meter';
            }

            if (isset($parameters['placeholder'])) {
                if (!isset($parameters['multiple'])) {
                    $attributes['placeholder'] = $parameters['placeholder'];
                } else {
                    $attributes['data-placeholder'] = $parameters['placeholder'];
                }
            }

            if (isset($parameters['tooltip'])) {
                $attributes = array_merge([
                  'data-toggle' => 'tooltip',
                  'data-placement' => $parameters['tooltip']['position'],
                  'title' => $parameters['tooltip']['title'],
                ], $attributes);
            }

            // Merge attributes and view variables
            if (isset($parameters['attributes'])) {
                $attributes = array_merge($attributes, $parameters['attributes']);
            }

            $parameters['attributes'] = $attributes;

            $view->with($parameters);
        });

        Form::component('bsInput', 'components.form.input', ['name', 'parameters' => []]);
        Form::component('bsTextarea', 'components.form.textarea', ['name', 'parameters' => []]);
        Form::component('bsSelect', 'components.form.select', ['name', 'parameters' => []]);
        Form::component('bsCheckbox', 'components.form.checkbox', ['name', 'parameters' => []]);
    }

    /**
     * Register the application services.
     */
    public function register()
    {
    }
}
