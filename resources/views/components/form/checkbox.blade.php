 <label class="custom-control custom-checkbox">
    {{ Form::hidden($name, 0) }}
    {{ Form::checkbox($name, 1, isset($checked) ? $checked : null, ['class' => 'custom-control-input']) }}
    <span class="custom-control-indicator"></span>
    <span class="custom-control-description">{{ $label }}</span>
</label>