<div class="box-body">

    {!! form_row('text', 'source', [
        'required' => true,
        'title' => trans('validation.attributes.source_path'),
        'label_class' => 'col-lg-3',
        'field_wrapper_class' => 'col-lg-9',
    ]) !!}

    {!! form_row('checkbox', 'active', [
        'label' => trans('validation.attributes.active'),
        'field_wrapper_class' => 'col-lg-offset-3 col-lg-9',
        'checked' => true
    ]) !!}

    {!! form_row('text', 'target', [
        'required' => true,
        'title' => trans('validation.attributes.target_path'),
        'label_class' => 'col-lg-3',
        'field_wrapper_class' => 'col-lg-9',
    ]) !!}

    {!! form_row('radios', 'type', [
        'required' => true,
        'title' => trans('validation.attributes.redirect_type'),
        'label_class' => 'col-lg-3',
        'field_wrapper_class' => 'col-lg-9',
        'choices' => \App\Models\Redirection::getRedirectTypes(),
    ]) !!}
</div>