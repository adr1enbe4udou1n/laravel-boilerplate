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
        View::composer('components.field', function (\Illuminate\View\View $view) {
            $data = $view->getData();

            $attributes = [];
            $rules = [];
            $parameters = $data['parameters'];

            $parameters = array_merge(['name' => $data['name']], $parameters);

            switch ($data['type']) {
                case 'text':
                    if (!isset($parameters['type'])) {
                        $parameters['type'] = 'text';
                    }

                    switch($parameters['type']) {
                        case 'email':
                            $rules[] = 'email';
                            break;
                    }
                    break;
                case 'password':
                    $data['type'] = 'text';
                    $parameters['type'] = 'password';
                    break;
                case 'select':
                    if (!isset($parameters['type'])) {
                        $parameters['type'] = 'select';
                    }

                    if (isset($parameters['multiple']) && $parameters['multiple']) {
                        $attributes['multiple'] = true;
                    }

                    $attributes['data-toggle'] = $parameters['type'];

                    if ($parameters['type'] === 'autocomplete') {
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
                case 'choices':
                    if (!isset($parameters['multiple'])) {
                        $parameters['multiple'] = false;
                    }

                    $parameters['type'] = $parameters['multiple']
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

            if(isset($parameters['editor'])) {
                $options = $parameters['editor'];

                $attributes['data-toggle'] = 'editor';
                if (isset($options['upload_url'])) {
                    $attributes['data-upload-url'] = $options['upload_url'];
                }
            }

            if (!isset($parameters['label_class'])) {
                $parameters['label_class'] = '';
            }

            if (!isset($parameters['field_class'])) {
                $parameters['field_class'] = '';
            }

            // Merge attributes and view variables
            if (isset($parameters['attributes'])) {
                $attributes = array_merge($attributes, $parameters['attributes']);
            }

            $parameters['attributes'] = $attributes;

            if (!isset($parameters['form_group'])) {
                $parameters['form_group'] = true;
            }

            $view->with($parameters)->withField($data['type'])->withParameters($parameters);
        });

        Form::component('bsText', 'components.field', ['name', 'parameters' => [], 'type' => 'text']);
        Form::component('bsPassword', 'components.field', ['name', 'parameters' => [], 'type' => 'password']);
        Form::component('bsTextarea', 'components.field', ['name', 'parameters' => [], 'type' => 'textarea']);
        Form::component('bsSelect', 'components.field', ['name', 'parameters' => [], 'type' => 'select']);
        Form::component('bsCheckbox', 'components.field', ['name', 'parameters' => [], 'type' => 'checkbox']);
        Form::component('bsChoices', 'components.field', ['name', 'parameters' => [], 'type' => 'choices']);
        Form::component('bsFile', 'components.field', ['name', 'parameters' => [], 'type' => 'file']);
        Form::component('bsImage', 'components.field', ['name', 'parameters' => [], 'type' => 'image']);
        Form::component('bsDatetime', 'components.field', ['name', 'parameters' => [], 'type' => 'datetime']);
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
