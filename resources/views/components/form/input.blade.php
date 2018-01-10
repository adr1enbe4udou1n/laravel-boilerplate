{{ Form::input($type, $name, $value, array_merge(['id' => $name, 'class' => $errors->has($name) ? 'form-control is-invalid' : 'form-control'], $attributes)) }}

@if ($errors->has($name))
    <div class="invalid-feedback">
        <span>{{ $errors->first($name) }}</span>
    </div>
@endif
