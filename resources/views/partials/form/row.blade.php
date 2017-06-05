<div class="form-group{{ isset($feedback_class) ? ' has-feedback' : '' }}{{ $errors->has($name) ? ' has-error' : '' }}">
    @isset($title)
        {{ Form::label($name, $title, ['class' =>  isset($label_class) ? "$label_class control-label" : 'control-label']) }}
    @endisset

    @if (isset($field_wrapper_class))
        <div class="{{ $field_wrapper_class }}">
            @endif

            {!! $widget !!}
            @include('partials.form.help')

            @if (isset($field_wrapper_class))
        </div>
    @endif
</div>