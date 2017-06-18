<div class="box-body">
    {!! form_row('text', 'name', [
        'required' => true,
        'title' => trans('validation.attributes.name'),
        'label_class' => 'col-lg-3',
        'field_wrapper_class' => 'col-lg-9',
    ]) !!}

    {!! form_row('text', 'display_name', [
        'title' => trans('validation.attributes.display_name'),
        'label_class' => 'col-lg-3',
        'field_wrapper_class' => 'col-lg-9',
    ]) !!}

    {!! form_row('text', 'description', [
        'title' => trans('validation.attributes.description'),
        'label_class' => 'col-lg-3',
        'field_wrapper_class' => 'col-lg-9'
    ]) !!}

    {!! form_row('checkboxes', 'permissions', [
        'title' => trans('validation.attributes.permissions'),
        'label_class' => 'col-lg-3',
        'field_wrapper_class' => 'col-lg-9',
        'choices' => $permissions,
        'choice_label' => 'display_name',
        'choice_tooltip' => [
            'position' => 'right',
            'title' => 'description',
        ]
    ]) !!}
</div>