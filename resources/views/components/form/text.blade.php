@component('components.form-group', $parameters)
    {{ Form::$type($name, isset($value) ? $value : null, array_merge(['id' => $name, 'class' => 'form-control'], $attributes)) }}
    @if (isset($feedback_class))
        <span class="{{ $feedback_class }} form-control-feedback"></span>
    @endif
@endcomponent