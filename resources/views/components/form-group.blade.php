<div class="form-group{{ isset($feedback_class) ? ' has-feedback' : '' }}{{ $errors->has($name) ? ' has-error' : '' }}" :class="{'has-error': errors.has('{{ $name }}') }">
    @isset($title)
        {{ Form::label($name, isset($required) && $required ? "$title *" : $title, ['class' =>  isset($label_class) ? "$label_class control-label" : 'control-label']) }}
    @endisset

    @if (isset($field_wrapper_class))
        <div class="{{ $field_wrapper_class }}">
            @endif

            {{ $slot }}
            @include('partials.help')

            @if (isset($field_wrapper_class))
        </div>
    @endif
</div>