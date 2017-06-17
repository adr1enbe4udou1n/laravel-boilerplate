@if(!isset($attributes))
    @php($attributes = [])
@endif
@if ($type === 'email')
    @php($rules = isset($rules) ? "email|$rules" : 'email')
@endif
@if ($type === 'tel')
    @php($rules = isset($rules) ? "phone:$name|$rules" : "phone:$name")
@endif
@if (isset($required) && $required)
    @php($attributes += ['required'])
    @php($rules = isset($rules) ? "required|$rules" : 'required')
@endif
@if (isset($rules))
    @php($attributes += ['v-validate' => "'$rules'"])
@endif
@if (isset($tooltip))
    @php($attributes += ['data-toggle' => 'tooltip', 'data-placement' => $tooltip['position'], 'title' => $tooltip['title']])
@endif

@if (isset($input_group_prefix) || isset($input_group_suffix))
<div class="input-group">
@endif
    @if (isset($input_group_prefix))
    <span class="input-group-addon">{!! $input_group_prefix !!}</span>
    @endif
    {{ Form::input($type, $name, null, ['id' => $name, 'class' => isset($field_class) ? "$field_class form-control" : 'form-control', 'placeholder' => isset($placeholder) ? $placeholder : $title] + $attributes) }}
    @if ($type === 'password' && isset($strength_meter) && $strength_meter)
    <password-strength-meter v-model="password" :required="{{ (isset($required) && $required) ? 'true' : 'false' }}" placeholder="@if(isset($placeholder)){{ $placeholder }}@else{{ $title }}@endif"></password-strength-meter>
    @endif
    @if (isset($feedback_class))
    <span class="{{ $feedback_class }} form-control-feedback"></span>
    @endif
    @if (isset($input_group_suffix))
    <span class="input-group-addon">{!! $input_group_suffix !!}</span>
    @endif
@if (isset($input_group_prefix) || isset($input_group_suffix))
</div>
@endif