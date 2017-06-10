<div class="box-body">
    {!! form_row('radios', 'locale', [
        'required' => true,
        'title' => trans('validation.attributes.locale'),
        'label_class' => 'col-lg-3',
        'field_wrapper_class' => 'col-lg-9',
        'choices' => $locales,
        'choice_label' => 'name',
    ]) !!}

    @if(old('route'))
        @php($route_list = [old('route') => route(old('route'), [], false)])
    @else
        @php($route_list = isset($meta) ? [$meta->route => $meta->uri] : [])
    @endif

    {!! form_row('autocomplete', 'route', [
        'required' => true,
        'title' => trans('validation.attributes.route'),
        'label_class' => 'col-lg-3',
        'field_wrapper_class' => 'col-lg-9',
        'options' => $route_list,
        'ajax_url' => route('admin.route.search', [
            'middleware' => 'metas'
        ]),
        'minimum_input_length' => 2,
        'item_value' => 'name',
        'item_label' => 'uri',
    ]) !!}

    {!! form_row('text', 'url', [
        'title' => trans('validation.attributes.url'),
        'label_class' => 'col-lg-3',
        'field_wrapper_class' => 'col-lg-9',
    ]) !!}

    {!! form_row('text', 'title', [
        'title' => trans('validation.attributes.title'),
        'label_class' => 'col-lg-3',
        'field_wrapper_class' => 'col-lg-9',
    ]) !!}

    {!! form_row('textarea', 'description', [
        'title' => trans('validation.attributes.description'),
        'label_class' => 'col-lg-3',
        'field_wrapper_class' => 'col-lg-9',
    ]) !!}
</div>