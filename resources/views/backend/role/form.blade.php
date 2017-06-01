<div class="box-body">
    @include('partials.form.widgets.input', [
        'type' => 'text',
        'name' => 'name',
        'title' => trans('validation.attributes.name'),
        'label_class' => 'col-lg-2',
        'field_wrapper_class' => 'col-lg-10',
    ])
    @include('partials.form.widgets.input', [
        'type' => 'text',
        'name' => 'display_name',
        'title' => trans('validation.attributes.display_name'),
        'label_class' => 'col-lg-2',
        'field_wrapper_class' => 'col-lg-10',
    ])
    @include('partials.form.widgets.input', [
        'type' => 'text',
        'name' => 'description',
        'title' => trans('validation.attributes.description'),
        'label_class' => 'col-lg-2',
        'field_wrapper_class' => 'col-lg-10',
    ])
    @include('partials.form.widgets.choices', [
        'type' => 'checkbox',
        'name' => 'permissions',
        'title' => trans('validation.attributes.permissions'),
        'label_class' => 'col-lg-2',
        'field_wrapper_class' => 'col-lg-10',
        'choices' => $permissions,
        'choice_label' => 'display_name'
    ])
</div>