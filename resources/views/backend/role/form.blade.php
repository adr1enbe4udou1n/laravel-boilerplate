<div class="box-body">
    {!! form_row('text', [
        'name' => 'name',
        'title' => trans('validation.attributes.name'),
        'label_class' => 'col-lg-2',
        'field_wrapper_class' => 'col-lg-10',
    ]) !!}

    {!! form_row('text', [
        'name' => 'display_name',
        'title' => trans('validation.attributes.display_name'),
        'label_class' => 'col-lg-2',
        'field_wrapper_class' => 'col-lg-10',
    ]) !!}

    {!! form_row('text', [
        'name' => 'description',
        'title' => trans('validation.attributes.description'),
        'label_class' => 'col-lg-2',
        'field_wrapper_class' => 'col-lg-10',
    ]) !!}

    {!! form_row('checkboxes', [
        'name' => 'permissions',
        'title' => trans('validation.attributes.permissions'),
        'label_class' => 'col-lg-2',
        'field_wrapper_class' => 'col-lg-10',
        'choices' => $permissions,
        'choice_label' => 'display_name',
        'choice_tooltip' => [
            'position' => 'right',
            'title' => 'description',
        ]
    ]) !!}
</div>