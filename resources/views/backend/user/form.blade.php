<div class="box-body">
    {!! form_row('email', [
        'name' => 'email',
        'title' => trans('validation.attributes.email'),
        'label_class' => 'col-lg-2',
        'field_wrapper_class' => 'col-lg-10',
        'input_group_prefix' => '<i class="fa fa-envelope"></i>',
    ]) !!}

    {!! form_row('checkbox', [
        'name' => 'active',
        'label' => trans('validation.attributes.active'),
        'field_wrapper_class' => 'col-lg-offset-2 col-lg-10',
    ]) !!}

    {!! form_row('text', [
        'name' => 'name',
        'title' => trans('validation.attributes.name'),
        'label_class' => 'col-lg-2',
        'field_wrapper_class' => 'col-lg-10',
    ]) !!}

    {!! form_row('checkboxes', [
        'name' => 'roles',
        'title' => trans('validation.attributes.roles'),
        'label_class' => 'col-lg-2',
        'field_wrapper_class' => 'col-lg-10',
        'choices' => $roles->get(),
    ]) !!}

    {!! form_row('password', [
        'name' => 'password',
        'title' => trans('validation.attributes.password'),
        'label_class' => 'col-lg-2',
        'field_wrapper_class' => 'col-lg-10',
        'input_group_prefix' => '<i class="fa fa-key"></i>',
    ]) !!}

    {!! form_row('password', [
        'name' => 'password_confirmation',
        'title' => trans('validation.attributes.password_confirmation'),
        'label_class' => 'col-lg-2',
        'field_wrapper_class' => 'col-lg-10',
        'input_group_prefix' => '<i class="fa fa-key"></i>',
    ]) !!}
</div>