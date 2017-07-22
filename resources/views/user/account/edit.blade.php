{{ Form::model($logged_in_user, ['route' => 'user.account.update', 'class' => 'form-horizontal', 'method' => 'PATCH']) }}

{{ Form::bsInput('name', [
    'required' => true,
    'title' => trans('validation.attributes.name'),
    'label_col_class' => 'col-md-4',
    'field_wrapper_class' => 'col-md-6',
]) }}

{{ Form::bsInput('email', [
    'required' => true,
    'type' => 'email',
    'title' => trans('validation.attributes.email'),
    'label_col_class' => 'col-md-4',
    'field_wrapper_class' => 'col-md-6',
]) }}

{{ Form::bsSelect('locale', [
    'required' => true,
    'title' => trans('validation.attributes.locale'),
    'label_col_class' => 'col-md-4',
    'field_wrapper_class' => 'col-md-6',
    'placeholder' => trans('labels.frontend.placeholders.locale'),
    'options' => $locales,
]) }}

{{ Form::bsSelect('timezone', [
    'required' => true,
    'title' => trans('validation.attributes.timezone'),
    'label_col_class' => 'col-md-4',
    'field_wrapper_class' => 'col-md-6',
    'placeholder' => trans('labels.frontend.placeholders.timezone'),
    'options' => array_combine(array_values($timezones), $timezones),
]) }}

<div class="form-group row">
    <div class="col-md-6 offset-md-4">
        {{ Form::submit(trans('buttons.update'), ['class' => 'btn btn-primary', 'id' => 'update-profile']) }}
    </div>
</div>

{{ Form::close() }}