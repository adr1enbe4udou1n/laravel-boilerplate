<div class="col-md-8">
    <div class="card">
        <div class="card-header">
            <h4>{{ $title }}</h4>
        </div>
        <div class="card-block">
            <b-form-fieldset
                    label-for="title"
                    label="@lang('validation.attributes.title')"
                    :horizontal="true"
                    :label-cols="2"
            >
                <b-form-input
                        id="title"
                        name="title"
                        :required="true"
                        placeholder="@lang('validation.attributes.title')"
                        value="{{ old('title', isset($post) ? $post->title : null) }}"
                ></b-form-input>
            </b-form-fieldset>

            <b-form-fieldset
                    label-for="summary"
                    label="@lang('validation.attributes.summary')"
                    :horizontal="true"
                    :label-cols="2"
            >
                <b-form-input
                        id="summary"
                        name="summary"
                        :textarea="true"
                        :rows="5"
                        placeholder="@lang('validation.attributes.summary')"
                        value="{{ old('summary', isset($post) ? $post->summary : null) }}"
                ></b-form-input>
            </b-form-fieldset>

            <b-form-fieldset
                    label-for="body"
                    label="@lang('validation.attributes.body')"
                    :horizontal="true"
                    :label-cols="2"
            >
                <b-form-input
                        id="body"
                        name="body"
                        :textarea="true"
                        :rows="5"
                        value="{{ old('body', isset($post) ? $post->body : null) }}"
                        data-toggle="editor"
                        data-upload-url="{{ route('admin.images.upload') }}"
                ></b-form-input>
            </b-form-fieldset>

            <b-form-fieldset
                    label-for="tags"
                    label="@lang('validation.attributes.tags')"
                    :horizontal="true"
                    :label-cols="2"
            >
                <b-form-select
                        id="tags"
                        name="tags"
                        :required="true"
                        :options="{{ json_encode(old('tags', isset($post) ? $post->tags->pluck('name', 'id') : [])) }}"
                        value="{{ old('tags', isset($post) ? $post->tags : null) }}"
                        data-toggle="autocomplete"
                        data-tags="true"
                        data-placeholder="@lang('labels.placeholders.tags')"
                        data-ajax-url="{{ route('admin.tags.search') }}"
                        :data-minimum_input_length="2"
                        data-item-value="id"
                        data-item-label="name"
                ></b-form-select>
            </b-form-fieldset>

            <b-form-fieldset
                    label-for="featured_image"
                    label="@lang('validation.attributes.image')"
                    :horizontal="true"
                    :label-cols="2"
            >
                <div class="media">
                    @if(isset($post) && $post->featured_image_url)
                        <img class="mr-2" src="{{ image_template_url('small', $post->featured_image_url) }}" alt="">
                    @endif
                    <div class="media-body">
                        <h6>@lang('labels.upload_image')</h6>
                        <input id="featured_image" name="featured_image" type="file" class="form-control">
                        <p class="form-text text-muted">
                            @lang('labels.descriptions.allowed_image_types')
                        </p>
                    </div>
                </div>
            </b-form-fieldset>
        </div>

        <div class="card-footer">
            <div class="row">
                <div class="col-md-6">
                    <a href="{{ route('admin.post.index') }}"
                       class="btn btn-danger btn-sm">@lang('buttons.back')</a>
                </div>
                <div class="col-md-6">
                    <input name="status" type="hidden" value="publish">
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

                    <b-form-fieldset
                            label-for="published_at"
                            label="@lang('validation.attributes.publish_at')"
                            :horizontal="true"
                            :label-cols="3"
                    >
                        <div data-toggle="datetimepicker" data-date-format="{{ $format ?? 'Y-m-d H:i' }}">
                            <b-input-group :right="iconCalendar" data-toggle>
                                <b-form-input
                                        id="published_at"
                                        name="published_at"
                                        :required="true"
                                        class="text-right"
                                        value="{{ old('published_at', isset($user) ? $user->published_at : \Carbon\Carbon::now()) }}"
                                        data-input
                                ></b-form-input>
                            </b-input-group>
                        </div>
                    </b-form-fieldset>

                    <b-form-fieldset
                            label-for="pinned"
                            label="@lang('validation.attributes.pinned')"
                            :horizontal="true"
                            :label-cols="3"
                    >
                        <input name="pinned" type="hidden" value="0">
                        <b-form-toggle
                                id="pinned"
                                name="pinned"
                                value="1"
                                checked="{{ old('pinned', isset($post) ? $post->pinned : null) }}"
                        ></b-form-toggle>
                    </b-form-fieldset>

                    <b-form-fieldset
                            label-for="promoted"
                            label="@lang('validation.attributes.promoted')"
                            :horizontal="true"
                            :label-cols="3"
                    >
                        <input name="promoted" type="hidden" value="0">
                        <b-form-toggle
                                id="promoted"
                                name="promoted"
                                value="1"
                                checked="{{ old('promoted', isset($post) ? $post->promoted : null) }}"
                        ></b-form-toggle>
                    </b-form-fieldset>
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
                    <b-form-fieldset
                            label-for="title"
                            label="@lang('validation.attributes.title')"
                            description="@lang('labels.backend.posts.descriptions.meta_title')"
                            :horizontal="true"
                            :label-cols="2"
                    >
                        <b-form-input
                                id="title"
                                name="meta[title]"
                                placeholder="@lang('labels.backend.posts.placeholders.meta_title')"
                                value="{{ old('title', isset($post) ? $post->title : null) }}"
                        ></b-form-input>
                    </b-form-fieldset>

                    <b-form-fieldset
                            label-for="description"
                            label="@lang('validation.attributes.description')"
                            description="@lang('labels.backend.posts.descriptions.meta_description')"
                            :horizontal="true"
                            :label-cols="2"
                    >
                        <b-form-input
                                id="description"
                                name="meta[description]"
                                :textarea="true"
                                :rows="5"
                                placeholder="@lang('labels.backend.posts.placeholders.meta_description')"
                                value="{{ old('description', isset($post) ? $post->description : null) }}"
                        ></b-form-input>
                    </b-form-fieldset>
                </div>
            </div>
        </div>
    </div>
</div>
