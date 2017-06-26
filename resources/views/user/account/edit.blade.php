{{ Form::model($logged_in_user, ['route' => 'user.account.update', 'class' => 'form-horizontal', 'method' => 'PATCH']) }}

{{ Form::bsText('name', [
    'required' => true,
    'title' => trans('validation.attributes.name'),
    'label_class' => 'col-md-4',
    'field_wrapper_class' => 'col-md-6',
]) }}

{{ Form::bsText('email', [
    'required' => true,
    'type' => 'email',
    'title' => trans('validation.attributes.email'),
    'label_class' => 'col-md-4',
    'field_wrapper_class' => 'col-md-6',
]) }}

{{ Form::bsSelect('locale', [
    'required' => true,
    'title' => trans('validation.attributes.locale'),
    'label_class' => 'col-md-4',
    'field_wrapper_class' => 'col-md-6',
    'placeholder' => trans('labels.frontend.placeholders.locale'),
    'options' => $locales,
]) }}

{{ Form::bsSelect('timezone', [
    'required' => true,
    'title' => trans('validation.attributes.timezone'),
    'label_class' => 'col-md-4',
    'field_wrapper_class' => 'col-md-6',
    'placeholder' => trans('labels.frontend.placeholders.timezone'),
    'options' => array_combine(array_values($timezones), $timezones),
]) }}

<div class="form-group">
    <div class="col-md-6 col-md-offset-4">
        {{ Form::submit(trans('buttons.update'), ['class' => 'btn btn-primary', 'id' => 'update-profile']) }}
    </div>
</div>

{{ Form::close() }}