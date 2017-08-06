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
                                    :state="validation.errors.hasOwnProperty('title') ? 'danger' : ''"
                                    :feedback="validation.errors.hasOwnProperty('title') ? validation.errors.title[0] : ''"
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
                                    :state="validation.errors.hasOwnProperty('summary') ? 'danger' : ''"
                                    :feedback="validation.errors.hasOwnProperty('summary') ? validation.errors.summary[0] : ''"
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
                                    :state="validation.errors.hasOwnProperty('body') ? 'danger' : ''"
                                    :feedback="validation.errors.hasOwnProperty('body') ? validation.errors.body[0] : ''"
                            >
                                <ckeditor
                                        id="body"
                                        name="body"
                                        v-model="post.body"
                                ></ckeditor>
                            </b-form-fieldset>

                            <b-form-fieldset
                                    label-for="tags"
                                    :label="$t('validation.attributes.tags')"
                                    :horizontal="true"
                                    :label-cols="2"
                            >
                                <v-select
                                        id="tags"
                                        name="tags"
                                        multiple
                                        :options="tags"
                                        v-model="post.tags"
                                        :on-search="getTags"
                                        :placeholder="$t('labels.placeholders.tags')"
                                        :taggable="true"
                                >
                                </v-select>
                            </b-form-fieldset>

                            <b-form-fieldset
                                    label-for="featured_image"
                                    :label="$t('validation.attributes.image')"
                                    :horizontal="true"
                                    :label-cols="2"
                                    :state="validation.errors.hasOwnProperty('image') ? 'danger' : ''"
                                    :feedback="validation.errors.hasOwnProperty('image') ? validation.errors.image[0] : ''"
                            >
                                <div class="media">
                                    <img v-if="post.featured_image_path !== null" class="mr-2" :src="`/imagecache/small/${post.featured_image_path}`" alt="">

                                    <div class="media-body">
                                        <h6>{{ $t('labels.upload_image') }}</h6>
                                        <input id="featured_image" name="featured_image" type="file" class="form-control" @change="onFileChange">
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
                                        <input type="submit" class="btn btn-success btn-sm pull-right" :value="$t('buttons.posts.save_and_publish')" @click="post.status = 'publish'">
                                        <button type="button" class="btn btn-success btn-sm dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-expanded="false" id="save-and-publish">
                                            <span class="sr-only"></span>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="javascript:void(0);" @click="post.status = 'draft'; onSubmit()">{{ $t('buttons.posts.save_as_draft') }}</a>
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
                                        <label class="col-lg-3 col-form-label">{{ $t('validation.attributes.status') }}</label>
                                        <div class="col-lg-9">
                                            <label class="col-form-label"><b-badge :variant="post.state">{{ $t(post.status_label) }}</b-badge></label>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label">{{ $t('labels.author') }}</label>
                                        <div class="col-lg-9">
                                            <label class="col-form-label">{{ post.owner.name }}</label>
                                        </div>
                                    </div>
                                    </template>

                                    <b-form-fieldset
                                            label-for="published_at"
                                            :label="$t('validation.attributes.publish_at')"
                                            :horizontal="true"
                                            :label-cols="3"
                                    >
                                        <div role="group" class="input-group">
                                            <flatpickr
                                                    id="published_at"
                                                    name="published_at"
                                                    :config="config"
                                                    :required="true"
                                                    v-model="post.published_at"
                                            ></flatpickr>
                                            <div class="input-group-addon" data-toggle>
                                                <i class="icon-calendar"></i>
                                            </div>
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
                                                v-model="post.pinned"
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
                                                v-model="post.promoted"
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
                config: {
                    wrap: true,
                    time_24hr: true,
                    enableTime: true,
                },
                tags: [],
                post: this.initPost(),
                validation: {
                    errors: {}
                }
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
                    tags: [],
                    featured_image: null,
                    featured_image_path: null,
                    status: null,
                    state: null,
                    status_label: null,
                    owner: {
                        name: null
                    },
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
                this.tags = [];
                this.post = this.initPost();

                if (!this.isNew) {
                    axios
                        .get(`/${this.$root.adminPath}/post/${this.id}`)
                        .then(response => {
                            this.post = response.data;
                            this.tags = this.post.tags;
                        });
                }
            },
            getTags(search) {
                axios
                    .get(`/${this.$root.adminPath}/tags/search`, {
                        params: {
                            q: search
                        }
                    })
                    .then(response => {
                        this.tags = response.data.items;
                    });
            },
            onFileChange(e) {
                let files = e.target.files || e.dataTransfer.files;
                if (!files.length) return;

                let reader = new FileReader();
                let post = this.post;

                reader.onload = (e) => {
                    post.featured_image = e.target.result;
                };
                reader.readAsDataURL(files[0]);
            },
            onSubmit() {
                let router = this.$router;
                let action = this.isNew ? `/${this.$root.adminPath}/post` : `/${this.$root.adminPath}/post/${this.id}`;

                axios
                    [this.isNew ? 'post' : 'patch'](action, this.post)
                    .then(response => {
                        toastr[response.data.status](response.data.message);
                        router.push('/post');
                    })
                    .catch(error => {
                        if (error.response.status === 422) {
                            this.validation.errors = error.response.data;
                            return;
                        }
                        toastr.error(error.response.data.error);
                    });
            }
        },
        created() {
            this.fetchData();
        },
        watch: {
            '$route': 'fetchData'
        }
    }
</script>
