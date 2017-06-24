<div class="box-body">
    {!! form_row('text', 'title', [
        'required' => true,
        'title' => trans('validation.attributes.title'),
        'label_class' => 'col-lg-3',
        'field_wrapper_class' => 'col-lg-9',
    ]) !!}

    {!! form_row('textarea', 'summary', [
        'title' => trans('validation.attributes.summary'),
        'label_class' => 'col-lg-3',
        'field_wrapper_class' => 'col-lg-9',
        'attributes' => [
            'rows' => 5
        ],
    ]) !!}

    <fieldset>
        <legend>@lang('labels.backend.titles.metas')</legend>
        {!! form_row('text', 'meta[title]', [
            'title' => trans('validation.attributes.title'),
            'description' => trans('labels.backend.posts.descriptions.meta_title'),
            'placeholder' => trans('labels.backend.posts.placeholders.meta_title'),
            'label_class' => 'col-lg-3',
            'field_wrapper_class' => 'col-lg-9',
        ]) !!}

        {!! form_row('textarea', 'meta[description]', [
            'title' => trans('validation.attributes.description'),
            'description' => trans('labels.backend.posts.descriptions.meta_description'),
            'placeholder' => trans('labels.backend.posts.placeholders.meta_description'),
            'label_class' => 'col-lg-3',
            'field_wrapper_class' => 'col-lg-9',
            'attributes' => [
                'rows' => 5
            ],
        ]) !!}
    </fieldset>
</div>