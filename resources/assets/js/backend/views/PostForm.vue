<template>
  <div class="animated fadeIn">
    <form @submit.prevent="onSubmit">
      <b-row>
        <b-col xl="8">
          <b-card>
            <h4 slot="header">{{ isNew ? $t('labels.backend.posts.titles.create') : $t('labels.backend.posts.titles.edit') }}</h4>
            <b-form-group
              name="title"
              :label="$t('validation.attributes.title')"
              :horizontal="true"
              :label-cols="2"
              :feedback="feedback('title')"
            >
              <b-form-input
                id="title"
                name="title"
                required
                :placeholder="$t('validation.attributes.title')"
                v-model="model.title"
                :state="state('title')"
              ></b-form-input>
            </b-form-group>

            <b-form-group
              name="summary"
              :label="$t('validation.attributes.summary')"
              :horizontal="true"
              :label-cols="2"
              :feedback="feedback('summary')"
            >
              <b-form-textarea
                id="summary"
                name="summary"
                :rows="5"
                :placeholder="$t('validation.attributes.summary')"
                v-model="model.summary"
                :state="state('summary')"
              ></b-form-textarea>
            </b-form-group>

            <b-form-group
              name="body"
              :label="$t('validation.attributes.body')"
              :horizontal="true"
              :label-cols="2"
            >
              <p-richtexteditor
                id="body"
                name="body"
                v-model="model.body"
              ></p-richtexteditor>
            </b-form-group>

            <b-form-group
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
            </b-form-group>

            <b-form-group
              name="featured_image"
              :label="$t('validation.attributes.image')"
              :horizontal="true"
              :label-cols="2"
              :feedback="feedback('featured_image')"
            >
              <div class="media">
                <img v-if="model.featured_image_path !== null" class="mr-2"
                     :src="`/imagecache/small/${model.featured_image_path}`" alt="">

                <div class="media-body">
                  <h6>{{ $t('labels.upload_image') }}</h6>
                  <b-form-file
                    id="featured_image"
                    name="featured_image"
                    :placeholder="$t('labels.no_file_chosen')"
                    :choose-label="$t('labels.choose_file')"
                    v-model="model.featured_image"
                    :state="state('featured_image')"
                  ></b-form-file>
                  <p class="form-text text-muted">
                    {{ $t('labels.descriptions.allowed_image_types') }}
                  </p>
                </div>
              </div>
            </b-form-group>

            <b-row slot="footer">
              <b-col md>
                <b-button to="/posts" variant="danger" size="sm">
                  {{ $t('buttons.back') }}
                </b-button>
              </b-col>
              <b-col md>
                <input name="status" type="hidden" value="publish">

                <b-dropdown right split :text="$t('buttons.posts.save_and_publish')" class="pull-right"
                            variant="success" size="sm" @click="model.status = 'publish'; onSubmit()"
                            :disabled="pending"
                            v-if="isNew || this.$app.user.can('edit posts') || this.$app.user.can('edit own posts')">
                  <b-dropdown-item @click="model.status = 'draft'; onSubmit()">{{ $t('buttons.posts.save_as_draft') }}
                  </b-dropdown-item>
                </b-dropdown>
              </b-col>
            </b-row>
          </b-card>
        </b-col>
        <b-col xl="4">
          <div role="tablist">
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
                      <label class="col-lg-3 col-form-label">{{ $t('validation.attributes.status') }}</label>
                      <b-col lg="9">
                        <label class="col-form-label">
                          <b-badge :variant="model.state">{{ $t(model.status_label) }}</b-badge>
                        </label>
                      </b-col>
                    </div>
                    <div class="form-group row">
                      <label class="col-lg-3 col-form-label">{{ $t('labels.author') }}</label>
                      <b-col lg="9">
                        <label class="col-form-label">{{ model.owner.name }}</label>
                      </b-col>
                    </div>
                  </template>

                  <b-form-group
                    v-if="this.$app.user.can('publish posts')"
                    name="published_at"
                    :label="$t('validation.attributes.published_at')"
                    :horizontal="true"
                    :label-cols="3"
                  >
                    <div role="group" class="input-group">
                      <p-datetimepicker
                        id="published_at"
                        name="published_at"
                        :config="config"
                        v-model="model.published_at"
                      ></p-datetimepicker>
                      <div class="input-group-addon" data-toggle>
                        <i class="icon-calendar"></i>
                      </div>
                      <div class="input-group-addon" data-clear>
                        <i class="icon-close"></i>
                      </div>
                    </div>
                  </b-form-group>

                  <b-form-group
                    v-if="this.$app.user.can('publish posts')"
                    name="unpublished_at"
                    :label="$t('validation.attributes.unpublished_at')"
                    :horizontal="true"
                    :label-cols="3"
                  >
                    <div role="group" class="input-group">
                      <p-datetimepicker
                        id="unpublished_at"
                        name="unpublished_at"
                        :config="config"
                        v-model="model.unpublished_at"
                      ></p-datetimepicker>
                      <div class="input-group-addon" data-toggle>
                        <i class="icon-calendar"></i>
                      </div>
                      <div class="input-group-addon" data-clear>
                        <i class="icon-close"></i>
                      </div>
                    </div>
                  </b-form-group>

                  <b-form-group
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
                  </b-form-group>

                  <b-form-group
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
                  </b-form-group>
                </b-card-body>
              </b-collapse>
            </b-card>
            <b-card no-body>
              <b-card-header header-tag="header" role="tab">
                <h5>
                  <a href="#" v-b-toggle.collapseTwo>
                    {{ $t('labels.backend.metas.titles.main') }}
                  </a>
                </h5>
              </b-card-header>
              <b-collapse id="collapseTwo" accordion="post-accordion" role="tabpanel">
                <b-card-body>
                  <b-form-group
                    name="meta-title"
                    :label="$t('validation.attributes.title')"
                    :description="$t('labels.backend.posts.descriptions.meta_title')"
                    :horizontal="true"
                    :label-cols="3"
                  >
                    <b-form-input
                      id="meta-title"
                      name="meta[title]"
                      :placeholder="$t('labels.backend.posts.placeholders.meta_title')"
                      v-model="model.title"
                    ></b-form-input>
                  </b-form-group>

                  <b-form-group
                    name="meta-description"
                    :label="$t('validation.attributes.description')"
                    :description="$t('labels.backend.posts.descriptions.meta_description')"
                    :horizontal="true"
                    :label-cols="3"
                  >
                    <b-form-textarea
                      id="meta-description"
                      name="meta[description]"
                      :rows="5"
                      :placeholder="$t('labels.backend.posts.placeholders.meta_description')"
                      v-model="model.description"
                    ></b-form-textarea>
                  </b-form-group>
                </b-card-body>
              </b-collapse>
            </b-card>
          </div>
        </b-col>
      </b-row>
    </form>
  </div>
</template>

<script>
import axios from 'axios'
import form from '../mixins/form'

export default {
  name: 'PostForm',
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
    onModelChanged () {
      if (this.model.tags) {
        this.model.tags = this.model.tags.map((item) => {
          return item.name
        })
      }
    },
    getTags (search) {
      axios
        .get(this.$app.route('admin.tags.search'), {
          params: {
            q: search
          }
        })
        .then((response) => {
          this.tagsOptions = response.data.items
        })
    }
  }
}
</script>
