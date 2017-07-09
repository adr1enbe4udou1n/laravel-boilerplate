<div class="card-block">
    {{ Form::bsText('name', [
        'required' => true,
        'title' => trans('validation.attributes.name'),
        'label_col_class' => 'col-lg-3',
        'field_wrapper_class' => 'col-lg-9',
    ]) }}

    {{ Form::bsText('email', [
        'required' => true,
        'title' => trans('validation.attributes.email'),
        'label_col_class' => 'col-lg-3',
        'field_wrapper_class' => 'col-lg-9',
        'input_group_prefix' => '<i class="fa fa-envelope"></i>',
    ]) }}

    {{ Form::bsCheckbox('active', [
        'label' => trans('validation.attributes.active'),
        'field_wrapper_class' => 'offset-lg-3 col-lg-9',
        'checked' => isset($user) ? $user->active : true
    ]) }}

    {{ Form::bsPassword('password', [
        'strength_meter' => true,
        'title' => trans('validation.attributes.password'),
        'label_col_class' => 'col-lg-3',
        'field_wrapper_class' => 'col-lg-9',
    ]) }}

    {{ Form::bsPassword('password_confirmation', [
        'title' => trans('validation.attributes.password_confirmation'),
        'label_col_class' => 'col-lg-3',
        'field_wrapper_class' => 'col-lg-9',
        'input_group_prefix' => '<i class="fa fa-key"></i>',
    ]) }}

    {{ Form::bsChoices('roles', [
        'title' => trans('validation.attributes.roles'),
        'multiple' => true,
        'label_col_class' => 'col-lg-3',
        'field_wrapper_class' => 'col-lg-9',
        'choices' => $roles,
        'choice_tooltip' => [
            'position' => 'right',
            'title' => 'description',
        ]
    ]) }}
</div>