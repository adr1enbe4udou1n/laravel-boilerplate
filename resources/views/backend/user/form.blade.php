<div class="card-block">
    @component('components.fieldset', [
        'name' => 'name',
        'title' => trans('validation.attributes.name'),
        'horizontal' => true,
        'label_cols' => 3
    ])
    {{ Form::bsInput('name', [
        'required' => true,
        'placeholder' => trans('validation.attributes.name'),
    ]) }}
    @endcomponent

    @component('components.fieldset', [
        'name' => 'email',
        'title' => trans('validation.attributes.email'),
        'horizontal' => true,
        'label_cols' => 3
    ])
    @component('components.input-group', [
        'left' => '<i class="icon-envelope"></i>'
    ])
    {{ Form::bsInput('email', [
        'required' => true,
        'placeholder' => trans('validation.attributes.email'),
    ]) }}
    @endcomponent
    @endcomponent

    @component('components.fieldset', [
        'name' => 'active',
        'title' => trans('validation.attributes.active'),
        'horizontal' => true,
        'label_cols' => 3
    ])
    {{ Form::bsToggle('active', [
        'checked' => isset($user) ? $user->active : true
    ]) }}
    @endcomponent

    @component('components.fieldset', [
        'name' => 'password',
        'title' => trans('validation.attributes.password'),
        'horizontal' => true,
        'label_cols' => 3
    ])
    {{ Form::bsInput('password', [
        'placeholder' => trans('validation.attributes.password'),
        'type' => 'password',
        'strength_meter' => true,
    ]) }}
    @endcomponent

    @component('components.fieldset', [
        'name' => 'password_confirmation',
        'title' => trans('validation.attributes.password_confirmation'),
        'horizontal' => true,
        'label_cols' => 3
    ])
    {{ Form::bsInput('password_confirmation', [
        'placeholder' => trans('validation.attributes.password_confirmation'),
        'type' => 'password',
    ]) }}
    @endcomponent

    @component('components.fieldset', [
        'name' => 'roles',
        'title' => trans('validation.attributes.roles'),
        'horizontal' => true,
        'label_cols' => 3
    ])
    {{ Form::bsChoices('roles', [
        'multiple' => true,
        'stacked' => true,
        'choices' => $roles,
        'choice_tooltip' => [
            'position' => 'right',
            'title' => 'description',
        ]
    ]) }}
    @endcomponent
</div>