@component('partials.form.group', ['name' => $name])
    @isset($title)
    {{ Form::label($name, $title, ['class' =>  isset($label_class) ? "$label_class control-label" : 'control-label']) }}
    @endisset

    @if (isset($field_wrapper_class))
    <div class="{{ $field_wrapper_class }}">
    @endif

        {{ Form::textarea($name, null, ['class' => isset($input_class) ? "$input_class form-control" : 'form-control'] + (isset($attributes) ? $attributes : [])) }}
        @include('partials.form.help')

    @if (isset($field_wrapper_class))
    </div>
    @endif
@endcomponent