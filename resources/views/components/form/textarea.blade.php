@component('components.form-group', $parameters)
    {{ Form::textarea($name, null, array_merge(['id' => $name, 'class' => 'form-control'], $attributes)) }}
@endcomponent