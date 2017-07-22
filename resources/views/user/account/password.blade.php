{{ Form::open(['route' => ['user.password.change'], 'class' => 'form-horizontal', 'method' => 'PATCH']) }}

<b-form-fieldset
        @if($errors->has('old_password'))
        state="danger"
        feedback="{{ $errors->first('old_password') }}"
        @endif
        label-for="old_password"
        label="@lang('validation.attributes.old_password')"
        :horizontal="true"
        :label-cols="4"
>
    <b-form-input
            id="old_password"
            name="old_password"
            type="password"
            :required="true"
            placeholder="@lang('validation.attributes.old_password')"
    ></b-form-input>
</b-form-fieldset>

<b-form-fieldset
        @if($errors->has('password'))
        state="danger"
        feedback="{{ $errors->first('password') }}"
        @endif
        label-for="password"
        label="@lang('validation.attributes.password')"
        :horizontal="true"
        :label-cols="4"
>
    <b-form-input
            id="password"
            name="password"
            type="password"
            :required="true"
            placeholder="@lang('validation.attributes.password')"
            data-toggle="password-strength-meter"
    ></b-form-input>
</b-form-fieldset>

<b-form-fieldset
        @if($errors->has('password_confirmation'))
        state="danger"
        feedback="{{ $errors->first('password_confirmation') }}"
        @endif
        label-for="password_confirmation"
        label="@lang('validation.attributes.password_confirmation')"
        :horizontal="true"
        :label-cols="4"
>
    <b-form-input
            id="password_confirmation"
            name="password_confirmation"
            type="password"
            :required="true"
            placeholder="@lang('validation.attributes.password_confirmation')"
    ></b-form-input>
</b-form-fieldset>

<div class="form-group row">
    <div class="col-md-6 offset-md-4">
        {{ Form::submit(trans('buttons.update'), ['class' => 'btn btn-primary', 'id' => 'change-password']) }}
    </div>
</div>

{{ Form::close() }}