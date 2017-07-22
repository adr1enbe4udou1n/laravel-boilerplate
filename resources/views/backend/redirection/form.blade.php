<div class="card-block">

    <b-form-fieldset
            @if($errors->has('source'))
            state="danger"
            feedback="{{ $errors->first('source') }}"
            @endif
            label-for="source"
            label="@lang('validation.attributes.source_path')"
            :horizontal="true"
            :label-cols="3"
    >
        <b-form-input
                id="source"
                name="source"
                :required="true"
                placeholder="@lang('validation.attributes.source_path')"
                value="{{ old('source', isset($redirection) ? $redirection->source : null) }}"
        ></b-form-input>
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
                checked="{{ old('active', isset($redirection) ? $redirection->active : null) }}"
        ></b-form-toggle>
    </b-form-fieldset>

    <b-form-fieldset
            @if($errors->has('target'))
            state="danger"
            feedback="{{ $errors->first('target') }}"
            @endif
            label-for="target"
            label="@lang('validation.attributes.target_path')"
            :horizontal="true"
            :label-cols="3"
    >
        <b-form-input
                id="target"
                name="target"
                :required="true"
                placeholder="@lang('validation.attributes.target_path')"
                value="{{ old('target', isset($redirection) ? $redirection->target : null) }}"
        ></b-form-input>
    </b-form-fieldset>

    <b-form-fieldset
            label="@lang('validation.attributes.redirect_type')"
            :horizontal="true"
            :label-cols="3"
    >
        <b-form-radio
                name="type"
                :required="true"
                :stacked="true"
                :options="{{ json_encode($redirection_types) }}"
                value="{{ old('type', isset($redirection) ? $redirection->type : null) }}"
        ></b-form-radio>
    </b-form-fieldset>
</div>