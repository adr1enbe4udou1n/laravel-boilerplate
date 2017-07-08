<div class="card-block">
    @if (isset($meta) && $meta->metable_type)
        <div class="form-group">
            <label class="control-label col-lg-3">@lang('validation.attributes.metable_type')</label>
            <div class="col-lg-9">
                <label class="control-label">@lang('labels.morphs.' . $meta->metable_type, ['id' => $meta->metable_id])</label>
            </div>
        </div>
    @else
        @if(old('route'))
            @php($route_list = [old('route') => trans('routes.' . old('route'))])
        @else
            @php($route_list = isset($meta) && $meta->route ? [$meta->route => trans('routes.' . $meta->route)] : [])
        @endif

        {{ Form::bsSelect('route', [
            'type' => 'autocomplete',
            'title' => trans('validation.attributes.route'),
            'placeholder' => trans('labels.placeholders.route'),
            'label_col_class' => 'col-lg-3',
            'field_wrapper_class' => 'col-lg-9',
            'options' => $route_list,
            'ajax_url' => route('admin.routes.search'),
            'minimum_input_length' => 2,
            'item_value' => 'name',
            'item_label' => 'uri',
        ]) }}
    @endif

    {{ Form::bsText('title', [
        'title' => trans('validation.attributes.title'),
        'label_col_class' => 'col-lg-3',
        'field_wrapper_class' => 'col-lg-9',
    ]) }}

    {{ Form::bsTextarea('description', [
        'title' => trans('validation.attributes.description'),
        'label_col_class' => 'col-lg-3',
        'field_wrapper_class' => 'col-lg-9',
    ]) }}
</div>