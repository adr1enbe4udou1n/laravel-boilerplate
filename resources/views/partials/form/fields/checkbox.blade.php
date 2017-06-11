<div class="checkbox icheck">
    <label>
        {{ Form::hidden($name, 0) }}
        {{ Form::checkbox($name, 1, isset($checked) ? $checked : null) }} {{ $label }}
    </label>
</div>
