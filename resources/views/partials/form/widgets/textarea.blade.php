@component('partials.form.group', ['name' => $name])
    @isset($title)
    {{ Form::label($name, $title, ['class' =>  isset($label_class) ? "$label_class control-label" : 'control-label']) }}
    @endisset

    @if (isset($field_wrapper_class))
    <div class="{{ $field_wrapper_class }}">
    @endif

        @if(!isset($attributes))
            @php($attributes = [])
        @endif
        @if (isset($tooltip))
            @php($attributes += ['data-toggle' => 'tooltip', 'data-placement' => $tooltip['position'], 'title' => $tooltip['title']])
        @endif

        {{ Form::textarea($name, null, ['class' => isset($field_class) ? "$field_class form-control" : 'form-control', 'placeholder' => isset($placeholder) ? $placeholder : $title] + $attributes) }}
        @include('partials.form.help')

    @if (isset($field_wrapper_class))
    </div>
    @endif
@endcomponent