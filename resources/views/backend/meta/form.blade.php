<div class="box-body">
    {!! form_row('radios', [
        'name' => 'locale',
        'required' => true,
        'title' => trans('validation.attributes.locale'),
        'label_class' => 'col-lg-2',
        'field_wrapper_class' => 'col-lg-10',
        'choices' => $locales,
        'choice_label' => 'name',
    ]) !!}

    @if(old('route'))
        @php($route_list = [old('route') => route(old('route'), [], false)])
    @else
        @php($route_list = isset($meta) ? [$meta->route => $meta->uri] : [])
    @endif

    {!! form_row('autocomplete', [
        'name' => 'route',
        'required' => true,
        'title' => trans('validation.attributes.route'),
        'label_class' => 'col-lg-2',
        'field_wrapper_class' => 'col-lg-10',
        'options' => $route_list,
        'ajax_url' => route('admin.route.search'),
        'ajax_query' => [
            'middleware' => 'metas'
        ],
        'minimum_input_length' => 2,
        'item_value' => 'name',
        'item_label' => 'uri',
    ]) !!}

    {!! form_row('text', [
        'name' => 'title',
        'title' => trans('validation.attributes.title'),
        'label_class' => 'col-lg-2',
        'field_wrapper_class' => 'col-lg-10',
    ]) !!}

    {!! form_row('textarea', [
        'name' => 'description',
        'title' => trans('validation.attributes.description'),
        'label_class' => 'col-lg-2',
        'field_wrapper_class' => 'col-lg-10',
    ]) !!}
</div>