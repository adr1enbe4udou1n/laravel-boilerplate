<div class="card-block">

    <b-form-fieldset
            @if($errors->has('name'))
            state="danger"
            feedback="{{ $errors->first('name') }}"
            @endif
            label-for="name"
            label="@lang('validation.attributes.form_type')"
            :horizontal="true"
            :label-cols="3"
    >
        <b-form-select
                id="name"
                name="name"
                :required="true"
                data-toggle="select2"
                data-placeholder="@lang('validation.attributes.form_type')"
                :options="{{ json_encode($form_types) }}"
                value="{{ old('name', isset($form_setting) ? $form_setting->name : null) }}"
        ></b-form-select>
    </b-form-fieldset>

    <b-form-fieldset
            @if($errors->has('recipients'))
            state="danger"
            feedback="{{ $errors->first('recipients') }}"
            @endif
            label-for="recipients"
            label="@lang('validation.attributes.recipients')"
            description="@lang('labels.backend.form_settings.descriptions.recipients')"
            :horizontal="true"
            :label-cols="3"
    >
        <b-form-input
                id="recipients"
                name="recipients"
                :textarea="true"
                :rows="5"
                :required="true"
                placeholder="@lang('validation.attributes.recipients')"
                value="{{ old('recipients', isset($form_setting) ? $form_setting->recipients : null) }}"
        ></b-form-input>
    </b-form-fieldset>

    <b-form-fieldset
            @if($errors->has('message'))
            state="danger"
            feedback="{{ $errors->first('message') }}"
            @endif
            label-for="message"
            label="@lang('validation.attributes.message')"
            description="@lang('labels.backend.form_settings.descriptions.message')"
            :horizontal="true"
            :label-cols="3"
    >
        <b-form-input
                id="message"
                name="message"
                :textarea="true"
                :rows="5"
                :required="true"
                placeholder="@lang('validation.attributes.message')"
                value="{{ old('message', isset($form_setting) ? $form_setting->message : null) }}"
        ></b-form-input>
    </b-form-fieldset>
</div>