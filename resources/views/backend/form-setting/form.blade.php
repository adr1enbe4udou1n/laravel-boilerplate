<div class="card-block">

    {{ Form::bsSelect('name', [
        'type' => 'select2',
        'required' => true,
        'title' => trans('validation.attributes.form_type'),
        'label_col_class' => 'col-lg-3',
        'field_wrapper_class' => 'col-lg-9',
        'options' => $form_types,
    ]) }}

    {{ Form::bsTextarea('recipients', [
        'title' => trans('validation.attributes.recipients'),
        'description' => trans('labels.backend.form_settings.descriptions.recipients'),
        'label_col_class' => 'col-lg-3',
        'field_wrapper_class' => 'col-lg-9',
        'attributes' => [
            'rows' => 5
        ]
    ]) }}

    {{ Form::bsTextarea('message', [
        'title' => trans('validation.attributes.message'),
        'description' => trans('labels.backend.form_settings.descriptions.message'),
        'label_col_class' => 'col-lg-3',
        'field_wrapper_class' => 'col-lg-9',
        'attributes' => [
            'rows' => 5
        ]
    ]) }}
</div>