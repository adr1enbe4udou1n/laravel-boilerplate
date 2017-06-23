<div class="box-body">
    {!! form_row('text', 'title', [
        'title' => trans('validation.attributes.title'),
        'label_class' => 'col-lg-3',
        'field_wrapper_class' => 'col-lg-9',
    ]) !!}

    {!! form_row('textarea', 'summary', [
        'title' => trans('validation.attributes.summary'),
        'label_class' => 'col-lg-3',
        'field_wrapper_class' => 'col-lg-9',
    ]) !!}
</div>