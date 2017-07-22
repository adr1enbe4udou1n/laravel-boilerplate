{{ Form::open(['route' => ['user.password.change'], 'class' => 'form-horizontal', 'method' => 'PATCH']) }}

@component('components.fieldset', [
    'name' => 'old_password',
    'title' => trans('validation.attributes.old_password'),
    'horizontal' => true,
    'label_cols' => 4
])
    {{ Form::bsInput('old_password', [
        'placeholder' => trans('validation.attributes.old_password'),
        'type' => 'password',
    ]) }}
@endcomponent

@component('components.fieldset', [
    'name' => 'password',
    'title' => trans('validation.attributes.new_password'),
    'horizontal' => true,
    'label_cols' => 4
])
    {{ Form::bsInput('password', [
        'required' => true,
        'placeholder' => trans('validation.attributes.new_password'),
        'type' => 'password',
        'strength_meter' => true,
    ]) }}
@endcomponent

@component('components.fieldset', [
    'name' => 'password_confirmation',
    'title' => trans('validation.attributes.new_password_confirmation'),
    'horizontal' => true,
    'label_cols' => 4
])
    {{ Form::bsInput('password_confirmation', [
        'required' => true,
        'placeholder' => trans('validation.attributes.new_password_confirmation'),
        'type' => 'password',
    ]) }}
@endcomponent

<div class="form-group row">
    <div class="col-md-6 offset-md-4">
        {{ Form::submit(trans('buttons.update'), ['class' => 'btn btn-primary', 'id' => 'change-password']) }}
    </div>
</div>

{{ Form::close() }}