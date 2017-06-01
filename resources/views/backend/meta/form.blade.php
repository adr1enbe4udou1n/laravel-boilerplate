<div class="box-body">
    @include('partials.form.choices', [
        'type' => 'radio',
        'name' => 'locale',
        'title' => trans('validation.attributes.locale'),
        'label_class' => 'col-lg-2',
        'field_wrapper_class' => 'col-lg-10',
        'choices' => $locales,
        'choice_label' => 'name',
    ])

    @if(old('route'))
        @php($route_list = [old('route') => route(old('route'), [], false)])
    @else
        @php($route_list = isset($meta) ? [$meta->route => $meta->uri] : [])
    @endif

    @include('partials.form.select', [
        'name' => 'route',
        'title' => trans('validation.attributes.route'),
        'label_class' => 'col-lg-2',
        'field_wrapper_class' => 'col-lg-10',
        'input_class' => 'select2-routes',
        'choices' => $route_list
    ])
    @include('partials.form.input', [
        'type' => 'text',
        'name' => 'title',
        'title' => trans('validation.attributes.title'),
        'label_class' => 'col-lg-2',
        'field_wrapper_class' => 'col-lg-10',
    ])
    @include('partials.form.textarea', [
        'name' => 'description',
        'title' => trans('validation.attributes.description'),
        'label_class' => 'col-lg-2',
        'field_wrapper_class' => 'col-lg-10',
    ])
</div>