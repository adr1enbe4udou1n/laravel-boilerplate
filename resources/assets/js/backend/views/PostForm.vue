<template>
    <div class="animated fadeIn">
        <form @submit.prevent="onSubmit">
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <h4>{{ isNew ? $t('labels.backend.posts.titles.create') : $t('labels.backend.posts.titles.edit') }}</h4>
                        </div>
                        <div class="card-block">
                            <b-form-fieldset
                                    label-for="title"
                                    :label="$t('validation.attributes.title')"
                                    :horizontal="true"
                                    :label-cols="2"
                            >
                                <b-form-input
                                        id="title"
                                        name="title"
                                        :required="true"
                                        :placeholder="$t('validation.attributes.title')"
                                        v-model="post.title"
                                ></b-form-input>
                            </b-form-fieldset>

                            <b-form-fieldset
                                    label-for="summary"
                                    :label="$t('validation.attributes.summary')"
                                    :horizontal="true"
                                    :label-cols="2"
                            >
                                <b-form-input
                                        id="summary"
                                        name="summary"
                                        :textarea="true"
                                        :rows="5"
                                        :placeholder="$t('validation.attributes.summary')"
                                        v-model="post.summary"
                                ></b-form-input>
                            </b-form-fieldset>

                            <b-form-fieldset
                                    label-for="body"
                                    :label="$t('validation.attributes.body')"
                                    :horizontal="true"
                                    :label-cols="2"
                            >
                                <b-form-input
                                        id="body"
                                        name="body"
                                        :textarea="true"
                                        :rows="5"
                                        v-model="post.body"
                                        data-toggle="editor"
                                        data-upload-url="/admin/images/upload"
                                ></b-form-input>
                            </b-form-fieldset>

                            <b-form-fieldset
                                    label-for="tags"
                                    :label="$t('validation.attributes.tags')"
                                    :horizontal="true"
                                    :label-cols="2"
                            >
                                <b-form-select
                                        id="tags"
                                        name="tags"
                                        :required="true"
                                        :options="tags"
                                        v-model="post.tags"
                                        data-toggle="autocomplete"
                                        data-tags="true"
                                        :data-placeholder="$t('labels.placeholders.tags')"
                                        data-ajax-url="/admin/tags/search"
                                        data-minimum-input-length="2"
                                        data-item-value="id"
                                        data-item-label="name"
                                ></b-form-select>
                            </b-form-fieldset>

                            <b-form-fieldset
                                    label-for="featured_image"
                                    :label="$t('validation.attributes.image')"
                                    :horizontal="true"
                                    :label-cols="2"
                            >
                                <div class="media">
                                    <img v-if="post.featured_image_url !== null" class="mr-2" :src="post.featured_image_url" alt="">
                                    <div class="media-body">
                                        <h6>{{ $t('labels.upload_image') }}</h6>
                                        <input id="featured_image" name="featured_image" type="file" class="form-control">
                                        <p class="form-text text-muted">
                                            {{ $t('labels.descriptions.allowed_image_types') }}
                                        </p>
                                    </div>
                                </div>
                            </b-form-fieldset>
                        </div>

                        <div class="card-footer">
                            <div class="row">
                                <div class="col-md-6">
                                    <router-link to="/post"
                                       class="btn btn-danger btn-sm">{{ $t('buttons.back') }}</router-link>
                                </div>
                                <div class="col-md-6">
                                    <input name="status" type="hidden" value="publish">
                                    <div class="btn-group pull-right">
                                        <input type="submit" class="btn btn-success btn-sm pull-right" :value="$t('buttons.posts.save_and_publish')">
                                        <button type="button" class="btn btn-success btn-sm dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-expanded="false">
                                            <span class="sr-only"></span>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" data-toggle="submit-link" data-target="[name=&quot;status&quot;]" data-value="draft" href="javascript:void(0);">{{ $t('buttons.posts.save_as_draft') }}</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div id="accordion" role="tablist">
                        <div class="card mb-0">
                            <div class="card-header" role="tab" id="headingOne">
                                <h5>
                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                                        {{ $t('labels.backend.posts.titles.publication') }}
                                    </a>
                                </h5>
                            </div>
                            <div id="collapseOne" class="collapse show" role="tabpanel" aria-labelledby="headingOne">
                                <div class="card-block">
                                    <template v-if="!isNew">
                                    <div class="form-group row">
                                        <label class="col-lg-3 text-right col-form-label">{{ $t('validation.attributes.status') }}</label>
                                        <div class="col-lg-9">
                                            <label class="col-form-label"><b-badge :variant="post.state">{{ $t(post.status_label) }}</b-badge></label>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-3 text-right col-form-label">{{ $t('labels.author') }}</label>
                                        <div class="col-lg-9">
                                            <label class="col-form-label">{{ post.owner }}</label>
                                        </div>
                                    </div>
                                    </template>

                                    <b-form-fieldset
                                            label-for="published_at"
                                            :label="$t('validation.attributes.publish_at')"
                                            :horizontal="true"
                                            :label-cols="3"
                                    >
                                        <div data-toggle="datetimepicker" data-date-format="Y-m-d H:i">
                                            <b-input-group :right="iconCalendar" data-toggle>
                                                <b-form-input
                                                        id="published_at"
                                                        name="published_at"
                                                        :required="true"
                                                        class="text-right"
                                                        v-model="user.published_at"
                                                        data-input
                                                ></b-form-input>
                                            </b-input-group>
                                        </div>
                                    </b-form-fieldset>

                                    <b-form-fieldset
                                            label-for="pinned"
                                            :label="$t('validation.attributes.pinned')"
                                            :horizontal="true"
                                            :label-cols="3"
                                    >
                                        <b-form-toggle
                                                id="pinned"
                                                name="pinned"
                                                value="1"
                                                :checked="post.pinned"
                                        ></b-form-toggle>
                                    </b-form-fieldset>

                                    <b-form-fieldset
                                            label-for="promoted"
                                            :label="$t('validation.attributes.promoted')"
                                            :horizontal="true"
                                            :label-cols="3"
                                    >
                                        <b-form-toggle
                                                id="promoted"
                                                name="promoted"
                                                value="1"
                                                :checked="post.promoted"
                                        ></b-form-toggle>
                                    </b-form-fieldset>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header" role="tab" id="headingTwo">
                                <h5>
                                    <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false">
                                        {{ $t('labels.backend.titles.metas') }}
                                    </a>
                                </h5>
                            </div>
                            <div id="collapseTwo" class="collapse" role="tabpanel" aria-labelledby="headingTwo">
                                <div class="card-block">
                                    <b-form-fieldset
                                            label-for="title"
                                            :label="$t('validation.attributes.title')"
                                            :description="$t('labels.backend.posts.descriptions.meta_title')"
                                            :horizontal="true"
                                            :label-cols="2"
                                    >
                                        <b-form-input
                                                id="title"
                                                name="meta[title]"
                                                :placeholder="$t('labels.backend.posts.placeholders.meta_title')"
                                                v-model="post.title"
                                        ></b-form-input>
                                    </b-form-fieldset>

                                    <b-form-fieldset
                                            label-for="description"
                                            :label="$t('validation.attributes.description')"
                                            :description="$t('labels.backend.posts.descriptions.meta_description')"
                                            :horizontal="true"
                                            :label-cols="2"
                                    >
                                        <b-form-input
                                                id="description"
                                                name="meta[description]"
                                                :textarea="true"
                                                :rows="5"
                                                :placeholder="$t('labels.backend.posts.placeholders.meta_description')"
                                                v-model="post.description"
                                        ></b-form-input>
                                    </b-form-fieldset>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</template>

<script>
    export default {
        name: 'post_form',
        props: ['id'],
        data() {
            return {
                user: window.settings.user,
                iconCalendar: '<i class="icon-calendar"></i>',
                tags: {},
                post: this.initPost()
            }
        },
        computed: {
            isNew() {
                return this.id === undefined;
            }
        },
        methods: {
            initPost() {
                return {
                    title: null,
                    summary: null,
                    body: null,
                    tags: {},
                    featured_image: null,
                    featured_image_url: null,
                    state: null,
                    status_label: null,
                    owner: null,
                    published_at: null,
                    pinned: null,
                    promoted: null,
                    meta: {
                        title: null,
                        description: null
                    }
                };
            },
            fetchData() {
                this.tags = {};
                this.post = initPost();

                if (!this.isNew) {
                    axios
                        .get(`/admin/post/${this.id}`)
                        .then(response => {
                            this.post = response.data;

                            // this.tags = $post->tags->pluck('name', 'name');
                        });
                }
            },
            onSubmit() {
                let action = this.isNew ? '/post/store' : `/post/${this.id}/update`;
            }
        },
        created() {
            this.fetchData();
        },
        watch: {
            '$route': 'fetchData'
        },
        mounted() {
            $.initPlugins();
        }
    }
</script>
