<div class="box-body">
    {!! form_row('text', 'name', [
        'required' => true,
        'title' => trans('validation.attributes.name'),
        'label_class' => 'col-lg-3',
        'field_wrapper_class' => 'col-lg-9',
    ]) !!}

    {!! form_row('email', 'email', [
        'required' => true,
        'title' => trans('validation.attributes.email'),
        'label_class' => 'col-lg-3',
        'field_wrapper_class' => 'col-lg-9',
        'input_group_prefix' => '<i class="fa fa-envelope"></i>',
    ]) !!}

    {!! form_row('checkbox', 'active', [
        'label' => trans('validation.attributes.active'),
        'field_wrapper_class' => 'col-lg-offset-3 col-lg-9',
        'checked' => true
    ]) !!}

    {!! form_row('password', 'password', [
        'title' => trans('validation.attributes.password'),
        'label_class' => 'col-lg-3',
        'field_wrapper_class' => 'col-lg-9',
        'input_group_prefix' => '<i class="fa fa-key"></i>',
    ]) !!}

    {!! form_row('password', 'password_confirmation', [
        'title' => trans('validation.attributes.password_confirmation'),
        'label_class' => 'col-lg-3',
        'field_wrapper_class' => 'col-lg-9',
        'input_group_prefix' => '<i class="fa fa-key"></i>',
    ]) !!}

    {!! form_row('checkboxes', 'roles', [
        'title' => trans('validation.attributes.roles'),
        'label_class' => 'col-lg-3',
        'field_wrapper_class' => 'col-lg-9',
        'choices' => $roles->get(),
    ]) !!}
</div>