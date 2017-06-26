@component('components.form-group', $parameters)
{{ Form::select($name, $options, null, array_merge(['id' => $name, 'class' => 'form-control'], $attributes)) }}
@endcomponent
