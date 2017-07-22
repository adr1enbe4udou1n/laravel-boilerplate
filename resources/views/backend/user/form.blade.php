<div class="card-block">

    <b-form-fieldset
            @if($errors->has('name'))
            state="danger"
            feedback="{{ $errors->first('name') }}"
            @endif
            label-for="name"
            label="@lang('validation.attributes.name')"
            :horizontal="true"
            :label-cols="3"
    >
        <b-input-group :left="iconUser">
            <b-form-input
                    id="name"
                    name="name"
                    :required="true"
                    placeholder="@lang('validation.attributes.name')"
                    value="{{ old('name', isset($user) ? $user->name : null) }}"
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
            :label-cols="3"
    >
        <b-input-group :left="iconEnvelope">
            <b-form-input
                    id="email"
                    name="email"
                    type="email"
                    :required="true"
                    placeholder="@lang('validation.attributes.email')"
                    value="{{ old('email', isset($user) ? $user->email : null) }}"
            ></b-form-input>
        </b-input-group>
    </b-form-fieldset>

    <b-form-fieldset
            label-for="active"
            label="@lang('validation.attributes.active')"
            :horizontal="true"
            :label-cols="3"
    >
        <input name="active" type="hidden" value="0">
        <b-form-toggle
                id="active"
                name="active"
                value="1"
                checked="{{ old('active', isset($user) ? $user->active : null) }}"
        ></b-form-toggle>
    </b-form-fieldset>

    <b-form-fieldset
            @if($errors->has('password'))
            state="danger"
            feedback="{{ $errors->first('password') }}"
            @endif
            label-for="password"
            label="@lang('validation.attributes.password')"
            :horizontal="true"
            :label-cols="3"
    >
        <b-form-input
                id="password"
                name="password"
                type="password"
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
            :label-cols="3"
    >
        <b-form-input
                id="password_confirmation"
                name="password_confirmation"
                type="password"
                placeholder="@lang('validation.attributes.password_confirmation')"
        ></b-form-input>
    </b-form-fieldset>

    <b-form-fieldset
            label="@lang('validation.attributes.roles')"
            :horizontal="true"
            :label-cols="3"
    >
        <div class="custom-controls-stacked">
        @foreach($roles as $role)
            <b-form-checkbox
                    name="roles[]"
                    :checked="{{ json_encode(old('roles', isset($user) ? $user->roles->pluck('id') : []), JSON_NUMERIC_CHECK) }}"
                    :value="{{ $role->id }}" v-cloak>
                {{ $role }}
            </b-form-checkbox>
        @endforeach
        </div>
    </b-form-fieldset>
</div>