<label class="switch switch-text switch-primary">
    {{ Form::hidden($name, 0) }}
    {{ Form::checkbox($name, 1, isset($checked) ? $checked : null, ['class' => 'switch-input']) }}
    <span data-on="On" data-Off="Off" class="switch-label"></span>
    <span class="switch-handle"></span>
</label>