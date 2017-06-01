<div class="box-body">
    @include('partials.form.input', [
        'type' => 'email',
        'name' => 'email',
        'title' => trans('validation.attributes.email'),
        'label_class' => 'col-lg-2',
        'field_wrapper_class' => 'col-lg-10',
        'input_group_prefix' => '<i class="fa fa-envelope"></i>',
    ])
    @include('partials.form.checkbox', [
        'name' => 'active',
        'title' => trans('validation.attributes.active'),
        'field_wrapper_class' => 'col-lg-offset-2 col-lg-10',
    ])
    @include('partials.form.input', [
        'type' => 'text',
        'name' => 'name',
        'title' => trans('validation.attributes.name'),
        'label_class' => 'col-lg-2',
        'field_wrapper_class' => 'col-lg-10',
    ])
    @include('partials.form.choices', [
        'type' => 'checkbox',
        'name' => 'roles',
        'title' => trans('validation.attributes.roles'),
        'label_class' => 'col-lg-2',
        'field_wrapper_class' => 'col-lg-10',
        'choices' => $roles->get(),
    ])
    @include('partials.form.input', [
        'type' => 'password',
        'name' => 'password',
        'title' => trans('validation.attributes.password'),
        'label_class' => 'col-lg-2',
        'field_wrapper_class' => 'col-lg-10',
        'input_group_prefix' => '<i class="fa fa-key"></i>',
    ])
    @include('partials.form.input', [
        'type' => 'password',
        'name' => 'password_confirmation',
        'title' => trans('validation.attributes.password_confirmation'),
        'label_class' => 'col-lg-2',
        'field_wrapper_class' => 'col-lg-10',
        'input_group_prefix' => '<i class="fa fa-key"></i>',
    ])
</div>