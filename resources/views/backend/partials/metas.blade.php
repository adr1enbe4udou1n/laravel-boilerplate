<fieldset>
    <legend>@lang('labels.backend.titles.metas')</legend>
    {!! form_row('text', 'title', [
        'title' => trans('validation.attributes.title'),
        'label_class' => 'col-lg-3',
        'field_wrapper_class' => 'col-lg-9',
    ]) !!}

    {!! form_row('textarea', 'description', [
        'title' => trans('validation.attributes.description'),
        'label_class' => 'col-lg-3',
        'field_wrapper_class' => 'col-lg-9',
        'attributes' => [
            'rows' => 5
        ],
    ]) !!}
</fieldset>
