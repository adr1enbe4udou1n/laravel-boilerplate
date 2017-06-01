<div class="form-group{{ $errors->has($name) ? ' has-error' : '' }}">
    @isset($title)
    {{ Form::label($name, $title, ['class' =>  isset($label_class) ? "$label_class control-label" : 'control-label']) }}
    @endisset

    @if (isset($field_wrapper_class))
    <div class="{{ $field_wrapper_class }}">
    @endif

        {{ Form::textarea($name, null, ['class' => isset($input_class) ? "$input_class form-control" : 'form-control'] + (isset($attributes) ? $attributes : [])) }}

        @if ($errors->has($name))
            <span class="help-block">
                <strong>{{ $errors->first($name) }}</strong>
            </span>
        @endif
    @if (isset($field_wrapper_class))
    </div>
    @endif
</div>