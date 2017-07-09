<div class="col-md-8">
    <div class="card">
        <div class="card-header">
            <h3>{{ $title }}</h3>
        </div>
        <div class="card-block">
            {{ Form::bsText('title', [
                'required' => true,
                'title' => trans('validation.attributes.title'),
                'label_col_class' => 'col-lg-2',
                'field_wrapper_class' => 'col-lg-10',
            ]) }}

            {{ Form::bsTextarea('summary', [
                'title' => trans('validation.attributes.summary'),
                'label_col_class' => 'col-lg-2',
                'field_wrapper_class' => 'col-lg-10',
                'attributes' => [
                    'rows' => 5
                ],
            ]) }}

            {{ Form::bsTextarea('body', [
                'title' => trans('validation.attributes.body'),
                'placeholder' => trans('labels.backend.posts.placeholders.body'),
                'label_col_class' => 'col-lg-2',
                'field_wrapper_class' => 'col-lg-10',
                'editor' => [
                    'upload_url' => route('admin.images.upload'),
                ]
            ]) }}

            @if(old('tags'))
                @php($tags = old('tags'))
            @else
                @php($tags = isset($post) ? $post->tags->pluck('name', 'id') : old('tags'))
            @endif

            {{ Form::bsSelect('tags[]', [
                'type' => 'autocomplete',
                'multiple' => true,
                'tags' => true,
                'title' => trans('validation.attributes.tags'),
                'placeholder' => trans('labels.placeholders.tags'),
                'label_col_class' => 'col-lg-2',
                'field_wrapper_class' => 'col-lg-10',
                'options' => isset($tags) ? $tags : [],
                'ajax_url' => route('admin.tags.search'),
                'minimum_input_length' => 2,
                'item_value' => 'id',
                'item_label' => 'name',
            ]) }}

            {{ Form::bsImage('featured_image', [
                'title' => trans('validation.attributes.image'),
                'label_col_class' => 'col-lg-2',
                'field_wrapper_class' => 'col-lg-10',
                'url' => isset($post) ? $post->featured_image_url : null
            ]) }}
        </div>

        <div class="card-footer">
            <div class="row">
                <div class="col-md-6">
                    <a href="{{ route('admin.post.index') }}"
                       class="btn btn-danger btn-sm">@lang('buttons.back')</a>
                </div>
                <div class="col-md-6">
                    {{ Form::hidden('status', 'publish') }}
                    <div class="btn-group pull-right">
                        {{ Form::submit(trans('buttons.posts.save_and_publish'), ['class' => 'btn btn-success btn-sm pull-right']) }}
                        <button type="button" class="btn btn-success btn-sm dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="sr-only"></span>
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" data-toggle="submit-link" data-target="[name=&quot;status&quot;]" data-value="draft" href="javascript:void(0);">@lang('buttons.posts.save_as_draft')</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-md-4">
    <div id="accordion" role="tablist" aria-multiselectable="true">
        <div class="card mb-0">
            <div class="card-header" role="tab" id="headingOne">
                <h4>
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true">
                        @lang('labels.backend.posts.titles.publication')
                    </a>
                </h4>
            </div>
            <div id="collapseOne" class="collapse show" role="tabpanel" aria-labelledby="headingOne">
                <div class="card-block">
                    @isset($post)
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label">@lang('validation.attributes.status')</label>
                        <div class="col-lg-9">
                            <label class="col-form-label">{!! state_html_label($post->state, trans($post->status_label)) !!}</label>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label">@lang('labels.author')</label>
                        <div class="col-lg-9">
                            <label class="col-form-label">{{ $post->owner }}</label>
                        </div>
                    </div>
                    @endisset
                    {{ Form::bsDatetime('published_at', [
                        'required' => true,
                        'value' => isset($post) ? null : \Carbon\Carbon::now(),
                        'title' => trans('validation.attributes.publish_at'),
                        'label_col_class' => 'col-lg-3',
                        'field_wrapper_class' => 'col-lg-7',
                    ]) }}
                    {{ Form::bsCheckbox('pinned', [
                        'label' => trans('validation.attributes.pinned'),
                        'field_wrapper_class' => 'offset-lg-3 col-lg-9',
                    ]) }}
                    {{ Form::bsCheckbox('promoted', [
                        'label' => trans('validation.attributes.promoted'),
                        'field_wrapper_class' => 'offset-lg-3 col-lg-9',
                    ]) }}
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header" role="tab" id="headingTwo">
                <h4>
                    <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false">
                        @lang('labels.backend.titles.metas')
                    </a>
                </h4>
            </div>
            <div id="collapseTwo" class="collapse" role="tabpanel" aria-labelledby="headingTwo">
                <div class="card-block">
                    {{ Form::bsText('meta[title]', [
                        'title' => trans('validation.attributes.title'),
                        'description' => trans('labels.backend.posts.descriptions.meta_title'),
                        'placeholder' => trans('labels.backend.posts.placeholders.meta_title'),
                        'label_col_class' => 'col-lg-2',
                        'field_wrapper_class' => 'col-lg-10',
                    ]) }}

                    {{ Form::bsTextarea('meta[description]', [
                        'title' => trans('validation.attributes.description'),
                        'description' => trans('labels.backend.posts.descriptions.meta_description'),
                        'placeholder' => trans('labels.backend.posts.placeholders.meta_description'),
                        'label_col_class' => 'col-lg-2',
                        'field_wrapper_class' => 'col-lg-10',
                    ]) }}
                </div>
            </div>
        </div>
    </div>
</div>
