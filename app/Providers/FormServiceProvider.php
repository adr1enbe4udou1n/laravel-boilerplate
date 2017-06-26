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
            $rules = [];
            $parameters = $data['parameters'];

            $parameters = array_merge(['name' => $data['name']], $parameters);

            switch ($view->name()) {
                case 'components.form.text':
                    if (!isset($parameters['type'])) {
                        $parameters['type'] = 'text';
                    }

                    switch($parameters['type']) {
                        case 'email':
                            $rules[] = 'email';
                            break;
                    }
                    break;
                case 'components.form.select':
                    if (!isset($parameters['type'])) {
                        $parameters['type'] = 'select';
                    }

                    $attributes['data-toggle'] = $parameters['type'];

                    if ($parameters['type']) {
                        $attributes = array_merge([
                            'data-ajax-url' => $parameters['ajax_url'],
                            'data-minimum-input-length' => $parameters['minimum_input_length'],
                            'data-item-value' => $parameters['item_value'],
                            'data-item-label' => $parameters['item_label']
                        ], $attributes);
                    }

                    if(isset($parameters['tags']) && $parameters['tags']) {
                        $attributes['data-tags'] = 'true';
                    }
                    break;
                case 'components.form.choices':
                    $parameters['type'] = isset($parameters['multiple']) && $parameters['multiple']
                        ? 'checkboxes'
                        : 'radios';
                    break;
            }

            if (isset($parameters['required']) && $parameters['required']) {
                $attributes['required'] = true;
                $rules[] = 'required';
            }

            if (!empty($rules)) {
                $attributes['v-validate'] = "'" . implode('|', $rules) . "'";
            }

            if (!isset($parameters['multiple'])) {
                if (isset($parameters['placeholder'])) {
                    $attributes['placeholder'] = $parameters['placeholder'];
                } elseif (isset($parameters['title'])) {
                    $attributes['placeholder'] = $parameters['title'];
                }
            }

            if (isset($parameters['tooltip'])) {
                $attributes = array_merge([
                    'data-toggle' => 'tooltip',
                    'data-placement' => $parameters['tooltip']['position'],
                    'title' => $parameters['tooltip']['title']
                ], $attributes);
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
        Form::component('bsCheckbox', 'components.form.checkbox', ['name', 'parameters' => []]);
        Form::component('bsChoices', 'components.form.choices', ['name', 'parameters' => []]);
        Form::component('bsFile', 'components.form.file', ['name', 'parameters' => []]);
        Form::component('bsImage', 'components.form.image', ['name', 'parameters' => []]);
        Form::component('bsDatetime', 'components.form.datetime', ['name', 'parameters' => []]);
        Form::component('bsEditor', 'components.form.editor', ['name', 'parameters' => []]);
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
