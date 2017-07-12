{{ Form::open(['route' => ['user.password.change'], 'class' => 'form-horizontal', 'method' => 'PATCH']) }}

{{ Form::bsPassword('old_password', [
    'title' => trans('validation.attributes.old_password'),
    'label_col_class' => 'col-md-4',
    'field_wrapper_class' => 'col-md-6',
]) }}

{{ Form::bsPassword('password', [
    'required' => true,
    'title' => trans('validation.attributes.new_password'),
    'strength_meter' => true,
    'label_col_class' => 'col-md-4',
    'field_wrapper_class' => 'col-md-6',
]) }}

{{ Form::bsPassword('password_confirmation', [
    'required' => true,
    'title' => trans('validation.attributes.new_password_confirmation'),
    'label_col_class' => 'col-md-4',
    'field_wrapper_class' => 'col-md-6',
]) }}

<div class="form-group row">
    <div class="col-md-6 offset-md-4">
        {{ Form::submit(trans('buttons.update'), ['class' => 'btn btn-primary', 'id' => 'change-password']) }}
    </div>
</div>

{{ Form::close() }}