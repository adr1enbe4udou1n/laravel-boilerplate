<div class="box-body">
    {!! form_row('text', 'title', [
        'required' => true,
        'title' => trans('validation.attributes.title'),
        'label_class' => 'col-lg-2',
        'field_wrapper_class' => 'col-lg-10',
    ]) !!}

    {!! form_row('textarea', 'summary', [
        'title' => trans('validation.attributes.summary'),
        'label_class' => 'col-lg-2',
        'field_wrapper_class' => 'col-lg-10',
        'attributes' => [
            'rows' => 5
        ],
    ]) !!}

    {!! form_row('textarea', 'body', [
        'title' => trans('validation.attributes.body'),
        'label_class' => 'col-lg-2',
        'field_wrapper_class' => 'col-lg-10',
    ]) !!}

    @if(old('tags'))
        @php($tags = old('tags'))
    @else
        @php($tags = isset($post) ? $post->tags->pluck('name', 'id') : old('tags'))
    @endif

    {!! form_row('autocomplete', 'tags[]', [
        'multiple' => true,
        'title' => trans('validation.attributes.tags'),
        'placeholder' => trans('labels.placeholders.tags'),
        'label_class' => 'col-lg-2',
        'field_wrapper_class' => 'col-lg-10',
        'options' => isset($tags) ? $tags : [],
        'ajax_url' => route('admin.tag.search'),
        'minimum_input_length' => 2,
        'item_value' => 'id',
        'item_label' => 'name',
    ]) !!}

    {!! form_row('image', 'featured_image', [
        'title' => trans('validation.attributes.image'),
        'label_class' => 'col-lg-2',
        'field_wrapper_class' => 'col-lg-10',
        'url' => isset($post) ? $post->featured_image_url : null
    ]) !!}

    <fieldset>
        <legend>@lang('labels.backend.posts.titles.publication')</legend>
        {!! form_row('radios', 'status', [
            'required' => true,
            'title' => trans('validation.attributes.status'),
            'label_class' => 'col-lg-2',
            'field_wrapper_class' => 'col-lg-10',
            'choices' => App\Models\Post::getStatuses(),
        ]) !!}
        {!! form_row('datetime', 'published_at', [
            'title' => trans('validation.attributes.publish_at'),
            'format' => 'YYYY-MM-DD hh:mm',
            'label_class' => 'col-lg-2',
            'field_wrapper_class' => 'col-lg-10',
        ]) !!}
        {!! form_row('checkbox', 'pinned', [
            'label' => trans('validation.attributes.pinned'),
            'field_wrapper_class' => 'col-lg-offset-2 col-lg-10',
        ]) !!}
        {!! form_row('checkbox', 'promoted', [
            'label' => trans('validation.attributes.promoted'),
            'field_wrapper_class' => 'col-lg-offset-2 col-lg-10',
        ]) !!}
    </fieldset>

    <fieldset>
        <legend>@lang('labels.backend.titles.metas')</legend>
        {!! form_row('text', 'meta[title]', [
            'title' => trans('validation.attributes.title'),
            'description' => trans('labels.backend.posts.descriptions.meta_title'),
            'placeholder' => trans('labels.backend.posts.placeholders.meta_title'),
            'label_class' => 'col-lg-2',
            'field_wrapper_class' => 'col-lg-10',
        ]) !!}

        {!! form_row('textarea', 'meta[description]', [
            'title' => trans('validation.attributes.description'),
            'description' => trans('labels.backend.posts.descriptions.meta_description'),
            'placeholder' => trans('labels.backend.posts.placeholders.meta_description'),
            'label_class' => 'col-lg-2',
            'field_wrapper_class' => 'col-lg-10',
            'attributes' => [
                'rows' => 5
            ],
        ]) !!}
    </fieldset>
</div>