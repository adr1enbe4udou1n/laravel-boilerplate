<div class="form-group{{ $errors->has($name) ? ' has-error' : '' }}">
    @if (isset($field_wrapper_class))
        <div class="{{ $field_wrapper_class }}">
    @endif
        <div class="checkbox icheck">
            <label>
                {{ Form::hidden($name, 0) }}
                {{ Form::checkbox($name, 1) }} {{ $title }}
            </label>
        </div>
        @if ($errors->has($name))
            <span class="help-block">
                <strong>{{ $errors->first($name) }}</strong>
            </span>
        @endif
    @if (isset($field_wrapper_class))
    </div>
    @endif
</div>