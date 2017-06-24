<div class="box-body">

    {!! form_row('select2', 'name', [
        'required' => true,
        'title' => trans('validation.attributes.form_type'),
        'label_class' => 'col-lg-3',
        'field_wrapper_class' => 'col-lg-9',
        'options' => $form_types,
    ]) !!}

    {!! form_row('textarea', 'recipients', [
        'title' => trans('validation.attributes.recipients'),
        'description' => trans('labels.backend.form_settings.descriptions.recipients'),
        'label_class' => 'col-lg-3',
        'field_wrapper_class' => 'col-lg-9',
        'attributes' => [
            'rows' => 5
        ]
    ]) !!}

    {!! form_row('textarea', 'message', [
        'title' => trans('validation.attributes.message'),
        'description' => trans('labels.backend.form_settings.descriptions.message'),
        'label_class' => 'col-lg-3',
        'field_wrapper_class' => 'col-lg-9',
        'attributes' => [
            'rows' => 5
        ]
    ]) !!}
</div>