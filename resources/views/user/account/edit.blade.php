{{ Form::model($loggedInUser, ['route' => 'user.account.update', 'class' => 'form-horizontal', 'method' => 'PATCH']) }}

@component('components.form-group', [
    'name' => 'name',
    'title' => __('validation.attributes.name'),
    'horizontal' => true,
    'label_cols' => 4
])
    {{ Form::text('name', null, [
        'placeholder' => __('validation.attributes.name'),
        'class' => 'form-control',
        'required' => true
    ]) }}
@endcomponent

@component('components.form-group', [
    'name' => 'email',
    'title' => __('validation.attributes.email'),
    'horizontal' => true,
    'label_cols' => 4
])
    {{ Form::email('email', null, [
        'title' => __('validation.attributes.email'),
        'class' => 'form-control',
        'required' => true
    ]) }}
@endcomponent

@component('components.form-group', [
    'name' => 'locale',
    'title' => __('validation.attributes.locale'),
    'horizontal' => true,
    'label_cols' => 4
])
    {{ Form::select('locale', $locales, null, [
        'placeholder' => __('labels.frontend.placeholders.locale'),
        'class' => 'form-control',
        'required' => true
    ]) }}
@endcomponent

@component('components.form-group', [
    'name' => 'timezone',
    'title' => __('validation.attributes.timezone'),
    'horizontal' => true,
    'label_cols' => 4
])
    {{ Form::select('timezone', array_combine(array_values($timezones), $timezones), null, [
        'placeholder' => __('labels.frontend.placeholders.timezone'),
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
