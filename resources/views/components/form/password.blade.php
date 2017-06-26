{{ Form::password($name, array_merge(['id' => $name, 'class' => 'form-control'], $attributes)) }}
@if (isset($strength_meter) && $strength_meter)
    <password-strength-meter v-model="password" :required="{{ (isset($required) && $required) ? 'true' : 'false' }}" placeholder="@if(isset($placeholder)){{ $placeholder }}@else{{ $title }}@endif"></password-strength-meter>
@endif
@if (isset($feedback_class))
    <span class="{{ $feedback_class }} form-control-feedback"></span>
@endif