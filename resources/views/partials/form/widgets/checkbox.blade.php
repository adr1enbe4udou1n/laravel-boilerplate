@component('partials.form.group', ['name' => $name])
    @if (isset($field_wrapper_class))
        <div class="{{ $field_wrapper_class }}">
    @endif
        <div class="checkbox icheck">
            <label>
                {{ Form::hidden($name, 0) }}
                {{ Form::checkbox($name, 1) }} {{ $title }}
            </label>
        </div>
        @include('partials.form.help')
    @if (isset($field_wrapper_class))
    </div>
    @endif
@endcomponent