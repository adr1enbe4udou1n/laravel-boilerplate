<div class="{{ isset($wrapper_class) ? $wrapper_class : '' }}{{ isset($feedback_class) ? ' has-feedback' : '' }}{{ $errors->has($name) ? ' has-error' : '' }}" :class="{'has-error': errors.has('{{ $name }}') }">
    {!! $field !!}
    @include('partials.form.help')
</div>