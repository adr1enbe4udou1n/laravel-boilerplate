@if ($type === 'password')
    {{ Form::password($name, array_merge(['id' => $name, 'class' => 'form-control'], $attributes)) }}
@else
    {{ Form::$type($name, $value ?? null, array_merge(['id' => $name, 'class' => 'form-control'], $attributes)) }}
@endif