<div class="card-block">
    {{ Form::bsText('name', [
        'required' => true,
        'title' => trans('validation.attributes.name'),
        'label_col_class' => 'col-lg-3',
        'field_wrapper_class' => 'col-lg-6',
    ]) }}

    {{ Form::bsText('email', [
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

    {{ Form::bsPassword('password', [
        'title' => trans('validation.attributes.password'),
        'strength_meter' => true,
        'label_col_class' => 'col-lg-3',
        'field_wrapper_class' => 'col-lg-6',
    ]) }}

    {{ Form::bsPassword('password_confirmation', [
        'title' => trans('validation.attributes.password_confirmation'),
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