{{ Form::model($logged_in_user, ['route' => 'user.account.update', 'class' => 'form-horizontal', 'method' => 'PATCH']) }}

@component('components.fieldset', [
    'name' => 'name',
    'title' => trans('validation.attributes.name'),
    'horizontal' => true,
    'label_cols' => 4
])
    {{ Form::bsInput('name', [
        'required' => true,
        'placeholder' => trans('validation.attributes.name'),
    ]) }}
@endcomponent

@component('components.fieldset', [
    'name' => 'email',
    'title' => trans('validation.attributes.email'),
    'horizontal' => true,
    'label_cols' => 4
])
    {{ Form::bsInput('email', [
        'required' => true,
        'type' => 'email',
        'title' => trans('validation.attributes.email'),
        'label_col_class' => 'col-md-4',
        'field_wrapper_class' => 'col-md-6',
    ]) }}
@endcomponent

@component('components.fieldset', [
    'name' => 'locale',
    'title' => trans('validation.attributes.locale'),
    'horizontal' => true,
    'label_cols' => 4
])
    {{ Form::bsSelect('locale', [
        'required' => true,
        'placeholder' => trans('labels.frontend.placeholders.locale'),
        'options' => $locales,
    ]) }}
@endcomponent

@component('components.fieldset', [
    'name' => 'timezone',
    'title' => trans('validation.attributes.timezone'),
    'horizontal' => true,
    'label_cols' => 4
])
    {{ Form::bsSelect('timezone', [
        'required' => true,
        'placeholder' => trans('labels.frontend.placeholders.timezone'),
        'options' => array_combine(array_values($timezones), $timezones),
    ]) }}
@endcomponent

<div class="form-group row">
    <div class="col-md-8 ml-auto">
        {{ Form::submit(trans('buttons.update'), ['class' => 'btn btn-primary', 'id' => 'update-profile']) }}
    </div>
</div>

{{ Form::close() }}