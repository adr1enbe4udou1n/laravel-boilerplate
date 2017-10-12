{{ Form::open(['route' => ['user.password.change'], 'class' => 'form-horizontal', 'method' => 'PATCH']) }}

@component('components.fieldset', [
    'name' => 'old_password',
    'title' => trans('validation.attributes.old_password'),
    'horizontal' => true,
    'label_cols' => 4
])
    {{ Form::password('old_password', [
        'placeholder' => trans('validation.attributes.old_password'),
        'class' => 'form-control',
        'required' => true
    ]) }}
@endcomponent

@component('components.fieldset', [
    'name' => 'password',
    'title' => trans('validation.attributes.new_password'),
    'horizontal' => true,
    'label_cols' => 4
])
    {{ Form::password('password', [
        'placeholder' => trans('validation.attributes.new_password'),
        'class' => 'form-control',
        'required' => true,
        'data-toggle' => 'password-strength-meter'
    ]) }}
@endcomponent

@component('components.fieldset', [
    'name' => 'password_confirmation',
    'title' => trans('validation.attributes.new_password_confirmation'),
    'horizontal' => true,
    'label_cols' => 4
])
    {{ Form::password('password_confirmation', [
        'placeholder' => trans('validation.attributes.new_password_confirmation'),
        'class' => 'form-control',
        'required' => true
    ]) }}
@endcomponent

<div class="form-group row">
    <div class="col-md-8 ml-auto">
        <button class="btn btn-primary">@lang('buttons.update')</button>
    </div>
</div>

{{ Form::close() }}