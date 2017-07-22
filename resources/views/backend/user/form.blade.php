<div class="card-block">
    {{ Form::bsInput('name', [
        'required' => true,
        'title' => trans('validation.attributes.name'),
        'label_col_class' => 'col-lg-3',
        'field_wrapper_class' => 'col-lg-6',
    ]) }}

    {{ Form::bsInput('email', [
        'required' => true,
        'title' => trans('validation.attributes.email'),
        'label_col_class' => 'col-lg-3',
        'field_wrapper_class' => 'col-lg-6',
        'input_group_prefix' => '<i class="icon-envelope"></i>',
    ]) }}

    {{ Form::bsToggle('active', [
        'title' => trans('validation.attributes.active'),
        'label_col_class' => 'col-lg-3',
        'field_wrapper_class' => 'col-lg-6',
        'checked' => isset($user) ? $user->active : true
    ]) }}

    {{ Form::bsInput('password', [
        'title' => trans('validation.attributes.password'),
        'type' => 'password',
        'strength_meter' => true,
        'label_col_class' => 'col-lg-3',
        'field_wrapper_class' => 'col-lg-6',
    ]) }}

    {{ Form::bsInput('password_confirmation', [
        'title' => trans('validation.attributes.password_confirmation'),
        'type' => 'password',
        'label_col_class' => 'col-lg-3',
        'field_wrapper_class' => 'col-lg-6',
    ]) }}

    {{ Form::bsChoices('roles', [
        'title' => trans('validation.attributes.roles'),
        'multiple' => true,
        'label_col_class' => 'col-lg-3',
        'field_wrapper_class' => 'col-lg-6',
        'stacked' => true,
        'choices' => $roles,
        'choice_tooltip' => [
            'position' => 'right',
            'title' => 'description',
        ]
    ]) }}
</div>