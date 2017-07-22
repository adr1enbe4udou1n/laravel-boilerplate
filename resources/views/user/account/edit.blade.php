{{ Form::model($logged_in_user, ['route' => 'user.account.update', 'class' => 'form-horizontal', 'method' => 'PATCH']) }}

<b-form-fieldset
        @if($errors->has('name'))
        state="danger"
        feedback="{{ $errors->first('name') }}"
        @endif
        label-for="name"
        label="@lang('validation.attributes.name')"
        :horizontal="true"
        :label-cols="4"
>
    <b-input-group :left="iconUser">
        <b-form-input
                id="name"
                name="name"
                :required="true"
                placeholder="@lang('validation.attributes.name')"
                value="{{ old('name', $logged_in_user->name) }}"
        ></b-form-input>
    </b-input-group>
</b-form-fieldset>

<b-form-fieldset
        @if($errors->has('email'))
        state="danger"
        feedback="{{ $errors->first('email') }}"
        @endif
        label-for="email"
        label="@lang('validation.attributes.email')"
        :horizontal="true"
        :label-cols="4"
>
    <b-input-group :left="iconEnvelope">
        <b-form-input
                id="email"
                name="email"
                type="email"
                :required="true"
                placeholder="@lang('validation.attributes.email')"
                value="{{ old('email', $logged_in_user->email) }}"
        ></b-form-input>
    </b-input-group>
</b-form-fieldset>

<b-form-fieldset
        @if($errors->has('locale'))
        state="danger"
        feedback="{{ $errors->first('locale') }}"
        @endif
        label-for="locale"
        label="@lang('validation.attributes.locale')"
        :horizontal="true"
        :label-cols="4"
>
    <b-form-select
            id="locale"
            name="locale"
            :required="true"
            placeholder="@lang('validation.attributes.locale')"
            :options="{{ json_encode($locales) }}"
            value="{{ old('locale', $logged_in_user->locale) }}"
    ></b-form-select>
</b-form-fieldset>

<b-form-fieldset
        @if($errors->has('timezone'))
        state="danger"
        feedback="{{ $errors->first('timezone') }}"
        @endif
        label-for="timezone"
        label="@lang('validation.attributes.timezone')"
        :horizontal="true"
        :label-cols="4"
>
    <b-form-select
            id="timezone"
            name="timezone"
            :required="true"
            placeholder="@lang('validation.attributes.timezone')"
            :options="{{ json_encode(array_combine(array_values($timezones), $timezones)) }}"
            value="{{ old('timezone', $logged_in_user->timezone) }}"
    ></b-form-select>
</b-form-fieldset>

<div class="form-group row">
    <div class="col-md-6 offset-md-4">
        {{ Form::submit(trans('buttons.update'), ['class' => 'btn btn-primary', 'id' => 'update-profile']) }}
    </div>
</div>

{{ Form::close() }}