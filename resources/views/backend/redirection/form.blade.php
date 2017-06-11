<div class="box-body">

    {!! form_row('text', 'path', [
        'required' => true,
        'title' => trans('validation.attributes.path'),
        'label_class' => 'col-lg-3',
        'field_wrapper_class' => 'col-lg-9',
    ]) !!}

    {!! form_row('checkbox', 'active', [
        'label' => trans('validation.attributes.active'),
        'field_wrapper_class' => 'col-lg-offset-3 col-lg-9',
        'checked' => true
    ]) !!}

    {!! form_row('radios', 'locale', [
        'required' => true,
        'title' => trans('validation.attributes.locale'),
        'label_class' => 'col-lg-3',
        'field_wrapper_class' => 'col-lg-9',
        'choices' => $locales,
        'choice_label' => 'name',
    ]) !!}

    @if(old('route'))
        @php($route_list = [old('route') => trans('routes.' . old('route'))])
    @else
        @php($route_list = isset($redirection) ? [$redirection->route => trans('routes.' . $redirection->route)] : [])
    @endif

    {!! form_row('autocomplete', 'route', [
        'required' => true,
        'title' => trans('validation.attributes.route'),
        'label_class' => 'col-lg-3',
        'field_wrapper_class' => 'col-lg-9',
        'options' => $route_list,
        'ajax_url' => route('admin.route.search'),
        'minimum_input_length' => 2,
        'item_value' => 'name',
        'item_label' => 'uri',
    ]) !!}

    {!! form_row('radios', 'type', [
        'required' => true,
        'title' => trans('validation.attributes.redirect_type'),
        'label_class' => 'col-lg-3',
        'field_wrapper_class' => 'col-lg-9',
        'choices' => \App\Models\Redirection::getRedirectTypes(),
    ]) !!}
</div>