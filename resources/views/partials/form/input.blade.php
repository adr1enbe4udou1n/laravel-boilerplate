<div class="form-group{{ $errors->has($name) ? ' has-error' : '' }}">
    @isset($title)
    {{ Form::label($name, $title, ['class' =>  isset($label_class) ? "$label_class control-label" : 'control-label']) }}
    @endisset

    @if (isset($field_wrapper_class))
    <div class="{{ $field_wrapper_class }}">
    @endif

        @if (isset($input_group_prefix) || isset($input_group_suffix))
        <div class="input-group">
        @endif
            @if (isset($input_group_prefix))
            <span class="input-group-addon">{!! $input_group_prefix !!}</span>
            @endif
            @if ($type === 'password')
                {{ Form::password($name, ['class' => isset($input_class) ? "$input_class form-control" : 'form-control'] + (isset($attributes) ? $attributes : [])) }}
            @else
                {{ Form::$type($name, null, ['class' => isset($input_class) ? "$input_class form-control" : 'form-control'] + (isset($attributes) ? $attributes : [])) }}
            @endif
            @if (isset($input_group_suffix))
            <span class="input-group-addon">{!! $input_group_suffix !!}</span>
            @endif
        @if (isset($input_group_prefix) || isset($input_group_suffix))
        </div>
        @endif

        @if ($errors->has($name))
            <span class="help-block">
                <strong>{{ $errors->first($name) }}</strong>
            </span>
        @endif
    @if (isset($field_wrapper_class))
    </div>
    @endif
</div>