@if (isset($input_group_prefix) || isset($input_group_suffix))
    <div class="input-group" @isset($input_group_attributes){!! Html::attributes($input_group_attributes) !!}@endisset>
        @endif
        @if (isset($input_group_prefix))
            <span class="input-group-addon">{!! $input_group_prefix !!}</span>
        @endif
        @if ($type === 'password')
            {{ Form::password($name, array_merge(['id' => $name, 'class' => 'form-control'], $attributes)) }}
        @else
            {{ Form::$type($name, isset($value) ? $value : null, array_merge(['id' => $name, 'class' => 'form-control'], $attributes)) }}
        @endif
        @if (isset($input_group_suffix))
            <span class="input-group-addon">{!! $input_group_suffix !!}</span>
        @endif
        @if (isset($input_group_prefix) || isset($input_group_suffix))
    </div>
@endif

@if (isset($strength_meter) && $strength_meter)
    <password-strength-meter v-model="password" :required="{{ (isset($required) && $required) ? 'true' : 'false' }}" placeholder="@if(isset($placeholder)){{ $placeholder }}@else{{ $title }}@endif"></password-strength-meter>
@endif
