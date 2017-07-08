<div class="checkbox">
    <label>
        {{ Form::hidden($name, 0) }}
        <label class="custom-control custom-checkbox">
            {{ Form::checkbox($name, 1, isset($checked) ? $checked : null, ['class' => 'custom-control-input']) }}
            <span class="custom-control-indicator"></span>
            <span class="custom-control-description">{{ $label }}</span>
        </label>

    </label>
</div>