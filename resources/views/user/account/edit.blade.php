{{ Form::model($loggedInUser, ['route' => 'user.account.update', 'class' => 'form-horizontal', 'method' => 'PATCH']) }}

{{ Form::bsText('name', __('validation.attributes.name'), null, ['required', 'placeholder' => __('validation.attributes.name')], 4) }}
{{ Form::bsEmail('email', __('validation.attributes.email'), null, ['required', 'placeholder' => __('validation.attributes.email')], 4) }}
{{ Form::bsSelect('locale', __('validation.attributes.locale'), $locales, null, ['required', 'placeholder' => __('validation.attributes.locale')], 4) }}
{{ Form::bsSelect('timezone', __('validation.attributes.timezone'), array_combine(array_values($timezones), $timezones), null, ['required', 'placeholder' => __('validation.attributes.timezone')], 4) }}

<div class="form-group row">
    <div class="col-md-8 ml-auto">
        <button class="btn btn-primary">@lang('buttons.update')</button>
    </div>
</div>

{{ Form::close() }}
