{{ Form::model($logged_in_user, ['route' => 'user.account.update', 'class' => 'form-horizontal', 'method' => 'PATCH']) }}

{!! form_row('text', 'name', [
    'required' => true,
    'title' => trans('validation.attributes.name'),
    'label_class' => 'col-md-4',
    'field_wrapper_class' => 'col-md-6',
]) !!}

{!! form_row('email', 'email', [
    'required' => true,
    'title' => trans('validation.attributes.email'),
    'label_class' => 'col-md-4',
    'field_wrapper_class' => 'col-md-6',
]) !!}

{!! form_row('select', 'locale', [
    'title' => trans('validation.attributes.locale'),
    'label_class' => 'col-md-4',
    'field_wrapper_class' => 'col-md-6',
    'placeholder' => trans('labels.frontend.placeholders.locale'),
    'options' => $locales,
]) !!}

{!! form_row('select', 'timezone', [
    'title' => trans('validation.attributes.timezone'),
    'label_class' => 'col-md-4',
    'field_wrapper_class' => 'col-md-6',
    'placeholder' => trans('labels.frontend.placeholders.timezone'),
    'options' => array_combine(array_values($timezones), $timezones),
]) !!}

<div class="form-group">
    <div class="col-md-6 col-md-offset-4">
        {{ Form::submit(trans('buttons.update'), ['class' => 'btn btn-primary', 'id' => 'update-profile']) }}
    </div>
</div>

{{ Form::close() }}