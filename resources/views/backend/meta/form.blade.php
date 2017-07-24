<div class="card-block">
    @if(isset($meta) && $meta->metable_type)
        <div class="form-group">
            <label class="control-label col-lg-3">@lang('validation.attributes.metable_type')</label>
            <div class="col-lg-9">
                <label class="control-label">@lang('labels.morphs.' . $meta->metable_type, ['id' => $meta->metable_id])</label>
            </div>
        </div>
    @else
        @php
            if(old('route')) {
                $route_list = [old('route') => trans('routes.' . old('route'))];
            }
            else {
                $route_list = isset($meta) && $meta->route ? [$meta->route => trans('routes.' . $meta->route)] : [];
            }
        @endphp

        @component('components.fieldset', [
            'name' => 'route',
            'title' => trans('validation.attributes.route'),
            'horizontal' => true,
            'label_cols' => 3
        ])
        {{ Form::bsSelect('route', [
            'type' => 'autocomplete',
            'placeholder' => trans('labels.placeholders.route'),
            'options' => $route_list,
            'ajax_url' => route('admin.routes.search'),
            'minimum_input_length' => 2,
            'item_value' => 'name',
            'item_label' => 'uri',
        ]) }}
        @endcomponent
    @endif

    @component('components.fieldset', [
        'name' => 'title',
        'title' => trans('validation.attributes.title'),
        'horizontal' => true,
        'label_cols' => 3
    ])
    {{ Form::bsInput('title', [
        'placeholder' => trans('validation.attributes.title'),
    ]) }}
    @endcomponent

    @component('components.fieldset', [
        'name' => 'description',
        'title' => trans('validation.attributes.description'),
        'horizontal' => true,
        'label_cols' => 3
    ])
    {{ Form::bsTextarea('description', [
        'placeholder' => trans('validation.attributes.description'),
    ]) }}
    @endcomponent
</div>