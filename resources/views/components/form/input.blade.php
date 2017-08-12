@if ($type === 'password')
    {{ Form::password($name, $attributes) }}
@else
    {{ Form::$type($name, $value ?? null, $attributes) }}
@endif
