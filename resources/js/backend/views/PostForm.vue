<template>
  <div>
    <form @submit.prevent="onSubmit">
      <b-row>
        <b-col xl="8">
          <b-card>
            <h3 class="card-title" slot="header">
              {{
                isNew
                  ? $t('labels.backend.posts.titles.create')
                  : $t('labels.backend.posts.titles.edit')
              }}
            </h3>
            <b-form-group
              :label="$t('validation.attributes.title')"
              label-for="title"
              horizontal
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
              :label="$t('validation.attributes.summary')"
              label-for="summary"
              horizontal
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
              :label="$t('validation.attributes.body')"
              label-for="body"
              horizontal
              :label-cols="2"
            >
              <p-richtexteditor
                name="body"
                v-model="model.body"
              ></p-richtexteditor>
            </b-form-group>

            <b-form-group
              :label="$t('validation.attributes.tags')"
              label-for="tags"
              horizontal
              :label-cols="2"
            >
              <v-select
                id="tags"
                name="tags"
                v-model="model.tags"
                :placeholder="$t('labels.placeholders.tags')"
                :options="tags"
                :multiple="true"
                :tags="true"
                @search-change="getTags"
              >
              </v-select>
            </b-form-group>

            <b-form-group
              :label="$t('validation.attributes.image')"
              label-for="featured_image"
              horizontal
              :label-cols="2"
              :feedback="feedback('featured_image')"
            >
              <div class="media">
                <b-img-style
                  v-if="model.featured_image_url"
                  :src="model.featured_image_url"
                  :width="120"
                  :height="80"
                  rounded
                  fluid
                  class="mr-2"
                ></b-img-style>

                <div class="media-body">
                  <h6>{{ $t('labels.upload_image') }}</h6>
                  <b-form-file
                    id="featured_image"
                    name="featured_image"
                    ref="featuredImageInput"
                    :placeholder="$t('labels.no_file_chosen')"
                    v-model="model.featured_image"
                    :state="state('featured_image')"
                    v-b-tooltip.hover
                    :title="$t('labels.descriptions.allowed_image_types')"
                  ></b-form-file>
                  <a
                    href="#"
                    class="d-block mt-1"
                    v-if="model.has_featured_image || model.featured_image"
                    @click.prevent="deleteFeaturedImage"
                  >
                    {{ $t('labels.delete_image') }}
                  </a>
                </div>
              </div>
            </b-form-group>

            <b-row slot="footer">
              <b-col md>
                <b-button to="/posts" exact variant="danger" size="sm">
                  {{ $t('buttons.back') }}
                </b-button>
              </b-col>
              <b-col md>
                <input name="status" type="hidden" value="publish" />

                <b-dropdown
                  right
                  split
                  :text="$t('buttons.posts.save_and_publish')"
                  class="float-right"
                  variant="success"
                  size="sm"
                  @click="
                    model.status = 'publish'
                    onSubmit()
                  "
                  :disabled="pending"
                  v-if="
                    isNew ||
                      this.$app.user.can('edit posts') ||
                      this.$app.user.can('edit own posts')
                  "
                >
                  <b-dropdown-item
                    @click="
                      model.status = 'draft'
                      onSubmit()
                    "
                  >
                    {{ $t('buttons.posts.save_as_draft') }}
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
                <h5 class="card-title">
                  <a href="#" v-b-toggle.collapseOne>
                    {{ $t('labels.backend.posts.titles.publication') }}
                  </a>
                </h5>
              </b-card-header>
              <b-collapse
                id="collapseOne"
                visible
                accordion="post-accordion"
                role="tabpanel"
              >
                <b-card-body>
                  <template v-if="!isNew">
                    <div class="form-group">
                      <b-row>
                        <label class="col-lg-3 col-form-label">{{
                          $t('validation.attributes.status')
                        }}</label>
                        <b-col lg="9">
                          <label class="col-form-label">
                            <b-badge :variant="model.state">{{
                              $t(model.status_label)
                            }}</b-badge>
                          </label>
                        </b-col>
                      </b-row>
                    </div>
                    <div class="form-group">
                      <b-row>
                        <label class="col-lg-3 col-form-label">{{
                          $t('labels.author')
                        }}</label>
                        <b-col lg="9">
                          <label class="col-form-label" v-if="model.owner">{{
                            model.owner.name
                          }}</label>
                          <label class="col-form-label" v-else>{{
                            $t('labels.anonymous')
                          }}</label>
                        </b-col>
                      </b-row>
                    </div>
                  </template>

                  <b-form-group
                    v-if="this.$app.user.can('publish posts')"
                    :label="$t('validation.attributes.published_at')"
                    label-for="published_at"
                    horizontal
                    :label-cols="3"
                  >
                    <b-input-group>
                      <p-datetimepicker
                        id="published_at"
                        name="published_at"
                        :config="config"
                        v-model="model.published_at"
                      ></p-datetimepicker>
                      <b-input-group-append>
                        <b-input-group-text data-toggle>
                          <i class="fe fe-calendar"></i>
                        </b-input-group-text>
                        <b-input-group-text data-clear>
                          <i class="fe fe-x-circle"></i>
                        </b-input-group-text>
                      </b-input-group-append>
                    </b-input-group>
                  </b-form-group>

                  <b-form-group
                    v-if="this.$app.user.can('publish posts')"
                    :label="$t('validation.attributes.unpublished_at')"
                    label-for="unpublished_at"
                    horizontal
                    :label-cols="3"
                  >
                    <b-input-group>
                      <p-datetimepicker
                        id="unpublished_at"
                        name="unpublished_at"
                        :config="config"
                        v-model="model.unpublished_at"
                      ></p-datetimepicker>
                      <b-input-group-append>
                        <b-input-group-text data-toggle>
                          <i class="fe fe-calendar"></i>
                        </b-input-group-text>
                        <b-input-group-text data-clear>
                          <i class="fe fe-x-circle"></i>
                        </b-input-group-text>
                      </b-input-group-append>
                    </b-input-group>
                  </b-form-group>

                  <div class="form-group">
                    <b-row>
                      <b-col lg="9" offset-lg="3">
                        <c-switch
                          name="pinned"
                          v-model="model.pinned"
                          :description="$t('validation.attributes.pinned')"
                        ></c-switch>
                      </b-col>
                    </b-row>
                  </div>

                  <div class="form-group">
                    <b-row>
                      <b-col lg="9" offset-lg="3">
                        <c-switch
                          name="promoted"
                          v-model="model.promoted"
                          :description="$t('validation.attributes.promoted')"
                        ></c-switch>
                      </b-col>
                    </b-row>
                  </div>
                </b-card-body>
              </b-collapse>
            </b-card>
            <b-card no-body>
              <b-card-header header-tag="header" role="tab">
                <h5 class="card-title">
                  <a href="#" v-b-toggle.collapseTwo>
                    {{ $t('labels.backend.metas.titles.main') }}
                  </a>
                </h5>
              </b-card-header>
              <b-collapse
                id="collapseTwo"
                accordion="post-accordion"
                role="tabpanel"
              >
                <b-card-body>
                  <b-form-group
                    :label="$t('validation.attributes.title')"
                    label-for="meta_title"
                    :description="
                      $t('labels.backend.posts.descriptions.meta_title')
                    "
                    horizontal
                    :label-cols="3"
                  >
                    <b-form-input
                      id="meta_title"
                      name="meta[title]"
                      :placeholder="
                        $t('labels.backend.posts.placeholders.meta_title')
                      "
                      v-model="model.meta.title"
                    ></b-form-input>
                  </b-form-group>

                  <b-form-group
                    :label="$t('validation.attributes.description')"
                    label-for="meta_description"
                    :description="
                      $t('labels.backend.posts.descriptions.meta_description')
                    "
                    horizontal
                    :label-cols="3"
                  >
                    <b-form-textarea
                      id="meta_description"
                      name="meta[description]"
                      :rows="5"
                      :placeholder="
                        $t('labels.backend.posts.placeholders.meta_description')
                      "
                      v-model="model.meta.description"
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
  data() {
    return {
      config: {
        wrap: true,
        time_24hr: true,
        enableTime: true
      },
      modelName: 'post',
      resourceRoute: 'posts',
      listPath: '/posts',
      tags: [],
      model: {
        title: null,
        summary: null,
        body: null,
        tags: [],
        featured_image: null,
        featured_image_url: null,
        status: null,
        state: null,
        status_label: null,
        owner: {
          name: null
        },
        published_at: null,
        unpublished_at: null,
        pinned: false,
        promoted: false,
        meta: {
          title: null,
          description: null
        },
        has_featured_image: false
      }
    }
  },
  methods: {
    async getTags(search) {
      let { data } = await axios.get(this.$app.route('admin.tags.search'), {
        params: {
          q: search
        }
      })

      this.tags = data.items
    },
    deleteFeaturedImage() {
      this.$refs.featuredImageInput.reset()
      this.model.featured_image_url = null
      this.model.has_featured_image = false
    }
  }
}
</script>
