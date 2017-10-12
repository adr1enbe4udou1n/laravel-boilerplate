<template>
    <div class="animated fadeIn">
        <form @submit.prevent="onSubmit">
            <div class="row">
                <div class="col-xl-8">
                    <b-card>
                        <h4 slot="header">{{ isNew ? $t('labels.backend.posts.titles.create') : $t('labels.backend.posts.titles.edit')}}</h4>
                        <b-form-fieldset
                                name="title"
                                :label="$t('validation.attributes.title')"
                                :horizontal="true"
                                :label-cols="2"
                                :invalid-feedback="feedback('title')"
                        >
                            <input
                                    id="title"
                                    name="title"
                                    class="form-control"
                                    v-validate="'required'"
                                    :placeholder="$t('validation.attributes.title')"
                                    v-model="model.title"
                            >
                        </b-form-fieldset>

                        <b-form-fieldset
                                name="summary"
                                :label="$t('validation.attributes.summary')"
                                :horizontal="true"
                                :label-cols="2"
                                :invalid-feedback="feedback('summary')"
                        >
                            <textarea
                                    id="summary"
                                    name="summary"
                                    :rows="5"
                                    :placeholder="$t('validation.attributes.summary')"
                                    class="form-control"
                                    v-model="model.summary"
                            ></textarea>
                        </b-form-fieldset>

                        <b-form-fieldset
                                name="body"
                                :label="$t('validation.attributes.body')"
                                :horizontal="true"
                                :label-cols="2"
                                :invalid-feedback="feedback('body')"
                        >
                            <ckeditor
                                    id="body"
                                    name="body"
                                    v-model="model.body"
                            ></ckeditor>
                        </b-form-fieldset>

                        <b-form-fieldset
                                name="tags"
                                :label="$t('validation.attributes.tags')"
                                :horizontal="true"
                                :label-cols="2"
                        >
                            <v-select
                                    id="tags"
                                    name="tags"
                                    multiple
                                    v-model="model.tags"
                                    :on-search="getTags"
                                    :options="tagsOptions"
                                    :placeholder="$t('labels.placeholders.tags')"
                                    :taggable="true"
                            >
                                <span slot="no-options">{{ $t('labels.no_results') }}</span>
                            </v-select>
                        </b-form-fieldset>

                        <b-form-fieldset
                                name="featured_image"
                                :label="$t('validation.attributes.image')"
                                :horizontal="true"
                                :label-cols="2"
                                :invalid-feedback="feedback('featured_image')"
                        >
                            <div class="media">
                                <img v-if="model.featured_image_path !== null" class="mr-2"
                                     :src="`/imagecache/small/${model.featured_image_path}`" alt="">

                                <div class="media-body">
                                    <h6>{{ $t('labels.upload_image') }}</h6>
                                    <input
                                            id="featured_image"
                                            name="featured_image"
                                            type="file"
                                            class="form-control"
                                            @change="onFileChange"
                                    >
                                    <p class="form-text text-muted">
                                        {{ $t('labels.descriptions.allowed_image_types') }}
                                    </p>
                                </div>
                            </div>
                        </b-form-fieldset>

                        <div class="row" slot="footer">
                            <div class="col-md-6">
                                <router-link to="/posts"
                                             class="btn btn-danger btn-sm">{{ $t('buttons.back') }}
                                </router-link>
                            </div>
                            <div class="col-md-6">
                                <input name="status" type="hidden" value="publish">
                                <div class="btn-group pull-right"
                                     v-if="isNew || this.$app.user.can('edit posts') || this.$app.user.can('edit own posts')">
                                    <input type="submit" class="btn btn-success btn-sm pull-right"
                                           :value="$t('buttons.posts.save_and_publish')"
                                           @click="model.status = 'publish'" :disabled="pending">
                                    <button type="button"
                                            class="btn btn-success btn-sm dropdown-toggle dropdown-toggle-split"
                                            data-toggle="dropdown" aria-expanded="false" id="save-and-publish">
                                        <span class="sr-only"></span>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="javascript:void(0);"
                                           @click="model.status = 'draft'; onSubmit()">{{ $t('buttons.posts.save_as_draft')
                                            }}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </b-card>
                </div>
                <div class="col-xl-4">
                    <div id="" role="tablist">
                        <b-card no-body class="mb-0">
                            <b-card-header header-tag="header" role="tab">
                                <h5>
                                    <a href="#" v-b-toggle.collapseOne>
                                        {{ $t('labels.backend.posts.titles.publication') }}
                                    </a>
                                </h5>
                            </b-card-header>
                            <b-collapse id="collapseOne" visible accordion="post-accordion" role="tabpanel">
                                <b-card-body>
                                    <template v-if="!isNew">
                                        <div class="form-group row">
                                            <label class="col-lg-3 col-form-label">{{ $t('validation.attributes.status')
                                                }}</label>
                                            <div class="col-lg-9">
                                                <label class="col-form-label">
                                                    <b-badge :variant="model.state">{{ $t(model.status_label) }}</b-badge>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-lg-3 col-form-label">{{ $t('labels.author') }}</label>
                                            <div class="col-lg-9">
                                                <label class="col-form-label">{{ model.owner.name }}</label>
                                            </div>
                                        </div>
                                    </template>

                                    <b-form-fieldset
                                            v-if="this.$app.user.can('publish posts')"
                                            name="published_at"
                                            :label="$t('validation.attributes.published_at')"
                                            :horizontal="true"
                                            :label-cols="3"
                                            :invalid-feedback="feedback('published_at')"
                                    >
                                        <div role="group" class="input-group">
                                            <flatpickr
                                                    id="published_at"
                                                    name="published_at"
                                                    :config="config"
                                                    v-model="model.published_at"
                                            ></flatpickr>
                                            <div class="input-group-addon" data-toggle>
                                                <i class="icon-calendar"></i>
                                            </div>
                                            <div class="input-group-addon" data-clear>
                                                <i class="icon-close"></i>
                                            </div>
                                        </div>
                                    </b-form-fieldset>

                                    <b-form-fieldset
                                            v-if="this.$app.user.can('publish posts')"
                                            name="unpublished_at"
                                            :label="$t('validation.attributes.unpublished_at')"
                                            :horizontal="true"
                                            :label-cols="3"
                                            :invalid-feedback="feedback('unpublished_at')"
                                    >
                                        <div role="group" class="input-group">
                                            <flatpickr
                                                    id="unpublished_at"
                                                    name="unpublished_at"
                                                    :config="config"
                                                    v-model="model.unpublished_at"
                                            ></flatpickr>
                                            <div class="input-group-addon" data-toggle>
                                                <i class="icon-calendar"></i>
                                            </div>
                                            <div class="input-group-addon" data-clear>
                                                <i class="icon-close"></i>
                                            </div>
                                        </div>
                                    </b-form-fieldset>

                                    <b-form-fieldset
                                            name="pinned"
                                            :label="$t('validation.attributes.pinned')"
                                            :horizontal="true"
                                            :label-cols="3"
                                    >
                                        <c-switch
                                                name="pinned"
                                                type="text"
                                                variant="primary"
                                                on="On"
                                                off="Off"
                                                v-model="model.pinned"
                                        ></c-switch>
                                    </b-form-fieldset>

                                    <b-form-fieldset
                                            name="promoted"
                                            :label="$t('validation.attributes.promoted')"
                                            :horizontal="true"
                                            :label-cols="3"
                                    >
                                        <c-switch
                                                name="promoted"
                                                type="text"
                                                variant="primary"
                                                on="On"
                                                off="Off"
                                                v-model="model.promoted"
                                        ></c-switch>
                                    </b-form-fieldset>
                                </b-card-body>
                            </b-collapse>
                        </b-card>
                        <b-card no-body>
                            <b-card-header header-tag="header" role="tab">
                                <h5>
                                    <a href="#" v-b-toggle.collapseTwo>
                                        {{ $t('labels.backend.titles.metas') }}
                                    </a>
                                </h5>
                            </b-card-header>
                            <b-collapse id="collapseTwo" accordion="post-accordion" role="tabpanel">
                                <b-card-body>
                                    <b-form-fieldset
                                            name="meta-title"
                                            :label="$t('validation.attributes.title')"
                                            :description="$t('labels.backend.posts.descriptions.meta_title')"
                                            :horizontal="true"
                                            :label-cols="2"
                                    >
                                        <input
                                                id="meta-title"
                                                name="meta[title]"
                                                class="form-control"
                                                :placeholder="$t('labels.backend.posts.placeholders.meta_title')"
                                                v-model="model.title"
                                        >
                                    </b-form-fieldset>

                                    <b-form-fieldset
                                            name="meta-description"
                                            :label="$t('validation.attributes.description')"
                                            :description="$t('labels.backend.posts.descriptions.meta_description')"
                                            :horizontal="true"
                                            :label-cols="2"
                                    >
                                        <textarea
                                                id="meta-description"
                                                name="meta[description]"
                                                :rows="5"
                                                :placeholder="$t('labels.backend.posts.placeholders.meta_description')"
                                                class="form-control"
                                                v-model="model.description"
                                        ></textarea>
                                    </b-form-fieldset>
                                </b-card-body>
                            </b-collapse>
                        </b-card>
                    </div>
                </div>
            </div>
        </form>
    </div>
</template>

<script>
  import axios from 'axios'
  import form from '../mixins/form'

  export default {
    name: 'post_form',
    mixins: [form],
    data () {
      return {
        config: {
          wrap: true,
          time_24hr: true,
          enableTime: true
        },
        modelName: 'post',
        listPath: '/posts',
        tagsOptions: [],
        model: {
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
          unpublished_at: null,
          pinned: null,
          promoted: null,
          meta: {
            title: null,
            description: null
          }
        }
      }
    },
    methods: {
      getTags (search) {
        axios
          .get(this.$app.route('admin.tags.search'), {
            params: {
              q: search
            }
          })
          .then(response => {
            this.tagsOptions = response.data.items
          })
      },
      onFileChange (e) {
        let files = e.target.files || e.dataTransfer.files
        if (!files.length) return

        this.model.featured_image = files[0]
      }
    }
  }
</script>
