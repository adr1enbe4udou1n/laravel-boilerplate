<div class="card-block">

    <b-form-fieldset
            label-for="name"
            label="@lang('validation.attributes.name')"
            :horizontal="true"
            :label-cols="2"
    >
        <b-form-input
                id="name"
                name="name"
                :required="true"
                placeholder="@lang('validation.attributes.name')"
                value="{{ old('name', isset($role) ? $role->name : null) }}"
        ></b-form-input>
    </b-form-fieldset>

    <b-form-fieldset
            label-for="display_name"
            label="@lang('validation.attributes.display_name')"
            :horizontal="true"
            :label-cols="2"
    >
        <b-form-input
                id="display_name"
                name="display_name"
                :required="true"
                placeholder="@lang('validation.attributes.display_name')"
                value="{{ old('display_name', isset($role) ? $role->display_name : null) }}"
        ></b-form-input>
    </b-form-fieldset>

    <b-form-fieldset
            label-for="description"
            label="@lang('validation.attributes.description')"
            :horizontal="true"
            :label-cols="2"
    >
        <b-form-input
                id="description"
                name="description"
                placeholder="@lang('validation.attributes.description')"
                value="{{ old('description', isset($role) ? $role->description : null) }}"
        ></b-form-input>
    </b-form-fieldset>

    <b-form-fieldset
            label-for="order"
            label="@lang('validation.attributes.order')"
            :horizontal="true"
            :label-cols="2"
    >
        <b-form-input
                id="order"
                name="order"
                type="number"
                :required="true"
                placeholder="@lang('validation.attributes.order')"
                value="{{ old('order', isset($role) ? $role->order : null) }}"
        ></b-form-input>
    </b-form-fieldset>

    <div class="form-group row">
        <label class="col-lg-2 col-form-label">@lang('validation.attributes.permissions')</label>
        <div class="col-lg-10">
        @foreach($permissions->chunk(4) as $chunk)
            <div class="row">
            @foreach($chunk as $category => $permissions)
                <div class="col-md-3">
                    <h4>@lang($category)</h4>
                    <div class="custom-controls-stacked">
                        @foreach($permissions as $key => $permission)
                            <b-form-checkbox
                                    name="permissions[]"
                                    :checked="{{ json_encode(old('permissions', isset($role) ? $role->permissions : [])) }}"
                                    value="{{ $key }}" v-cloak>
                                @lang($permission['display_name'])
                            </b-form-checkbox>
                        @endforeach
                    </div>
                </div>
            @endforeach
            </div>
        @endforeach
        </div>
    </div>
</div>