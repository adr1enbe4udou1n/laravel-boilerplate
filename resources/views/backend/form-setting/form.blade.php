<div class="card-block">

    @component('components.fieldset', [
        'name' => 'select2',
        'title' => trans('validation.attributes.form_type'),
        'horizontal' => true,
        'label_cols' => 3
    ])
    {{ Form::bsSelect('name', [
        'type' => 'select2',
        'required' => true,
        'placeholder' => trans('validation.attributes.form_type'),
        'options' => $form_types,
    ]) }}
    @endcomponent

    @component('components.fieldset', [
        'name' => 'recipients',
        'title' => trans('validation.attributes.recipients'),
        'horizontal' => true,
        'label_cols' => 3
    ])
    {{ Form::bsTextarea('recipients', [
        'placeholder' => trans('validation.attributes.recipients'),
        'description' => trans('labels.backend.form_settings.descriptions.recipients'),
        'attributes' => [
            'rows' => 5
        ]
    ]) }}
    @endcomponent

    @component('components.fieldset', [
        'name' => 'message',
        'title' => trans('validation.attributes.message'),
        'horizontal' => true,
        'label_cols' => 3
    ])
    {{ Form::bsTextarea('message', [
        'placeholder' => trans('validation.attributes.message'),
        'description' => trans('labels.backend.form_settings.descriptions.message'),
        'attributes' => [
            'rows' => 5
        ]
    ]) }}
    @endcomponent
</div>