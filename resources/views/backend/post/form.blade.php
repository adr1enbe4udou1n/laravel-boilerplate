<div class="col-md-8">
    <div class="card">
        <div class="card-header">
            <h4>{{ $title }}</h4>
        </div>
        <div class="card-block">
            @component('components.fieldset', [
                'name' => 'title',
                'title' => trans('validation.attributes.title'),
                'horizontal' => true,
                'label_cols' => 2
            ])
                {{ Form::bsInput('title', [
                    'required' => true,
                    'placeholder' => trans('validation.attributes.title'),
                ]) }}
            @endcomponent

            @component('components.fieldset', [
                'name' => 'summary',
                'title' => trans('validation.attributes.summary'),
                'horizontal' => true,
                'label_cols' => 2
            ])
            {{ Form::bsTextarea('summary', [
                'placeholder' => trans('validation.attributes.summary'),
                'attributes' => [
                    'rows' => 5
                ],
            ]) }}
            @endcomponent

            @component('components.fieldset', [
                'name' => 'body',
                'title' => trans('validation.attributes.body'),
                'horizontal' => true,
                'label_cols' => 2
            ])
            {{ Form::bsTextarea('body', [
                'placeholder' => trans('labels.backend.posts.placeholders.body'),
                'editor' => [
                    'upload_url' => route('admin.images.upload'),
                ]
            ]) }}
            @endcomponent

            @if(old('tags'))
                @php($tags = old('tags'))
            @else
                @php($tags = isset($post) ? $post->tags->pluck('name', 'id') : old('tags'))
            @endif

            @component('components.fieldset', [
                'name' => 'tags[]',
                'title' => trans('validation.attributes.tags'),
                'horizontal' => true,
                'label_cols' => 2
            ])
            {{ Form::bsSelect('tags[]', [
                'type' => 'autocomplete',
                'multiple' => true,
                'tags' => true,
                'placeholder' => trans('labels.placeholders.tags'),
                'options' => isset($tags) ? $tags : [],
                'ajax_url' => route('admin.tags.search'),
                'minimum_input_length' => 2,
                'item_value' => 'id',
                'item_label' => 'name',
            ]) }}
            @endcomponent

            @component('components.fieldset', [
                'name' => 'featured_image',
                'title' => trans('validation.attributes.image'),
                'horizontal' => true,
                'label_cols' => 2
            ])
            {{ Form::bsImage('featured_image', [
                'url' => isset($post) ? $post->featured_image_url : null
            ]) }}
            @endcomponent
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
                <h5>
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true">
                        @lang('labels.backend.posts.titles.publication')
                    </a>
                </h5>
            </div>
            <div id="collapseOne" class="collapse show" role="tabpanel" aria-labelledby="headingOne">
                <div class="card-block">
                    @isset($post)
                    <div class="form-group row">
                        <label class="col-lg-3 text-right col-form-label">@lang('validation.attributes.status')</label>
                        <div class="col-lg-9">
                            <label class="col-form-label">{!! state_html_label($post->state, trans($post->status_label)) !!}</label>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-3 text-right col-form-label">@lang('labels.author')</label>
                        <div class="col-lg-9">
                            <label class="col-form-label">{{ $post->owner }}</label>
                        </div>
                    </div>
                    @endisset
                    @component('components.fieldset', [
                        'name' => 'published_at',
                        'title' => trans('validation.attributes.publish_at'),
                        'horizontal' => true,
                        'label_cols' => 3
                    ])
                    {{ Form::bsDatetime('published_at', [
                        'required' => true,
                        'value' => isset($post) ? null : \Carbon\Carbon::now(),
                    ]) }}
                    @endcomponent
                    @component('components.fieldset', [
                        'name' => 'pinned',
                        'title' => trans('validation.attributes.pinned'),
                        'horizontal' => true,
                        'label_cols' => 3
                    ])
                    {{ Form::bsToggle('pinned') }}
                    @endcomponent
                    @component('components.fieldset', [
                        'name' => 'promoted',
                        'title' => trans('validation.attributes.promoted'),
                        'horizontal' => true,
                        'label_cols' => 3
                    ])
                    {{ Form::bsToggle('promoted') }}
                    @endcomponent
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header" role="tab" id="headingTwo">
                <h5>
                    <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false">
                        @lang('labels.backend.titles.metas')
                    </a>
                </h5>
            </div>
            <div id="collapseTwo" class="collapse" role="tabpanel" aria-labelledby="headingTwo">
                <div class="card-block">
                    @component('components.fieldset', [
                        'name' => 'meta[title]',
                        'title' => trans('validation.attributes.title'),
                        'horizontal' => true,
                        'label_cols' => 2
                    ])
                    {{ Form::bsInput('meta[title]', [
                        'description' => trans('labels.backend.posts.descriptions.meta_title'),
                        'placeholder' => trans('labels.backend.posts.placeholders.meta_title'),
                    ]) }}
                    @endcomponent

                    @component('components.fieldset', [
                        'name' => 'meta[description]',
                        'title' => trans('validation.attributes.description'),
                        'horizontal' => true,
                        'label_cols' => 2
                    ])
                    {{ Form::bsTextarea('meta[description]', [
                        'description' => trans('labels.backend.posts.descriptions.meta_description'),
                        'placeholder' => trans('labels.backend.posts.placeholders.meta_description'),
                    ]) }}
                    @endcomponent
                </div>
            </div>
        </div>
    </div>
</div>
