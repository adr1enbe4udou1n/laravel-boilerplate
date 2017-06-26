@component('components.form-group', $parameters)
    {{ Form::file($name, array_merge(['id' => $name, 'class' => 'form-control'], $attributes)) }}
@endcomponent