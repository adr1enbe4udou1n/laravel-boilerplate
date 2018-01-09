{{ Form::open(['route' => ['user.password.change'], 'class' => 'form-horizontal', 'method' => 'PATCH']) }}

{{ Form::bsPassword('old_password', __('validation.attributes.old_password'), ['required', 'placeholder' => __('validation.attributes.old_password')], 4) }}
{{ Form::bsPassword('password', __('validation.attributes.new_password'), ['required', 'placeholder' => __('validation.attributes.new_password'), 'data-toggle' => 'password-strength-meter'], 4) }}
{{ Form::bsPassword('password_confirmation', __('validation.attributes.new_password_confirmation'), ['required', 'placeholder' => __('validation.attributes.new_password_confirmation')], 4) }}

<div class="form-group row">
    <div class="col-md-8 ml-auto">
        <button class="btn btn-primary">@lang('buttons.update')</button>
    </div>
</div>

{{ Form::close() }}
