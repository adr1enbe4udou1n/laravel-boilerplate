<div class="card-block">
    @if(isset($meta) && $meta->metable_type)
        <div class="form-group">
            <label class="control-label col-lg-3">@lang('validation.attributes.metable_type')</label>
            <div class="col-lg-9">
                <label class="control-label">@lang('labels.morphs.' . $meta->metable_type, ['id' => $meta->metable_id])</label>
            </div>
        </div>
    @else
        <b-form-fieldset
                label-for="route"
                label="@lang('validation.attributes.route')"
                :horizontal="true"
                :label-cols="3"
        >
            <b-form-select
                    id="route"
                    name="route"
                    :required="true"
                    :options="{{ json_encode($route_list) }}"
                    value="{{ old('route', isset($meta) ? $meta->route : null) }}"
                    data-toggle="autocomplete"
                    data-placeholder="@lang('labels.placeholders.route')"
                    data-ajax-url="{{ route('admin.routes.search') }}"
                    :data-minimum_input_length="2"
                    data-item-value="name"
                    data-item-label="uri"
            ></b-form-select>
        </b-form-fieldset>
    @endif

    <b-form-fieldset
            label-for="title"
            label="@lang('validation.attributes.title')"
            :horizontal="true"
            :label-cols="3"
    >
        <b-form-input
                id="title"
                name="title"
                placeholder="@lang('validation.attributes.title')"
                value="{{ old('title', isset($meta) ? $meta->title : null) }}"
        ></b-form-input>
    </b-form-fieldset>

    <b-form-fieldset
            label-for="description"
            label="@lang('validation.attributes.description')"
            :horizontal="true"
            :label-cols="3"
    >
        <b-form-input
                id="description"
                name="description"
                :textarea="true"
                :rows="5"
                placeholder="@lang('validation.attributes.description')"
                value="{{ old('description', isset($meta) ? $meta->description : null) }}"
        ></b-form-input>
    </b-form-fieldset>
</div>