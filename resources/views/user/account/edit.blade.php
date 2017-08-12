{{ Form::model($logged_in_user, ['route' => 'user.account.update', 'class' => 'form-horizontal', 'method' => 'PATCH']) }}

@component('components.fieldset', [
    'name' => 'name',
    'title' => trans('validation.attributes.name'),
    'horizontal' => true,
    'label_cols' => 4
])
    {{ Form::text('name', null, [
        'placeholder' => trans('validation.attributes.name'),
        'class' => 'form-control',
        'v-validate' => "'required'"
    ]) }}
@endcomponent

@component('components.fieldset', [
    'name' => 'email',
    'title' => trans('validation.attributes.email'),
    'horizontal' => true,
    'label_cols' => 4
])
    {{ Form::email('email', null, [
        'title' => trans('validation.attributes.email'),
        'class' => 'form-control',
        'v-validate' => "'required|email'"
    ]) }}
@endcomponent

@component('components.fieldset', [
    'name' => 'locale',
    'title' => trans('validation.attributes.locale'),
    'horizontal' => true,
    'label_cols' => 4
])
    {{ Form::select('locale', $locales, null, [
        'placeholder' => trans('labels.frontend.placeholders.locale'),
        'class' => 'form-control',
        'v-validate' => "'required'",
    ]) }}
@endcomponent

@component('components.fieldset', [
    'name' => 'timezone',
    'title' => trans('validation.attributes.timezone'),
    'horizontal' => true,
    'label_cols' => 4
])
    {{ Form::select('timezone', array_combine(array_values($timezones), $timezones), null, [
        'placeholder' => trans('labels.frontend.placeholders.timezone'),
        'class' => 'form-control',
        'v-validate' => "'required'",
    ]) }}
@endcomponent

<div class="form-group row">
    <div class="col-md-8 ml-auto">
        {{ Form::submit(trans('buttons.update'), ['class' => 'btn btn-primary', 'id' => 'update-profile']) }}
    </div>
</div>

{{ Form::close() }}