<template>
  <div>
    <form @submit.prevent="onSubmit">
      <b-row class="justify-content-center">
        <b-col xl="6">
          <b-card>
            <h3 class="card-title" slot="header">
              {{
                isNew
                  ? $t('labels.backend.metas.titles.create')
                  : $t('labels.backend.metas.titles.edit')
              }}
            </h3>

            <template v-if="model.metable_type !== null">
              <div class="form-group row">
                <label class="col-lg-3 col-form-label">{{
                  $t('validation.attributes.metable_type')
                }}</label>
                <b-col lg="9">
                  <label class="col-form-label">{{
                    $t(`labels.morphs.${model.metable_type}`, {
                      id: model.metable_id
                    })
                  }}</label>
                </b-col>
              </div>
            </template>
            <template v-else>
              <b-form-group
                :label="$t('validation.attributes.route')"
                label-for="route"
                horizontal
                :label-cols="3"
                :feedback="feedback('route')"
                :state="state('route')"
              >
                <b-form-select
                  id="route"
                  name="route"
                  v-model="model.route"
                  :options="routes"
                >
                  <template slot="first">
                    <option :value="null">
                      -- {{ $t('labels.placeholders.route') }} --
                    </option>
                  </template>
                </b-form-select>
              </b-form-group>
            </template>

            <b-form-group
              :label="$t('validation.attributes.title')"
              label-for="title"
              horizontal
              :label-cols="3"
              :feedback="feedback('title')"
            >
              <b-form-input
                id="title"
                name="title"
                :placeholder="$t('validation.attributes.title')"
                v-model="model.title"
                :state="state('title')"
              ></b-form-input>
            </b-form-group>

            <b-form-group
              :label="$t('validation.attributes.description')"
              label-for="description"
              horizontal
              :label-cols="3"
              :feedback="feedback('description')"
            >
              <b-form-textarea
                id="description"
                name="description[meta]"
                :rows="5"
                :placeholder="$t('validation.attributes.description')"
                v-model="model.description"
                :state="state('description')"
              ></b-form-textarea>
            </b-form-group>

            <b-row slot="footer">
              <b-col md>
                <b-button to="/metas" exact variant="danger" size="sm">
                  {{ $t('buttons.back') }}
                </b-button>
              </b-col>
              <b-col md>
                <b-button
                  type="submit"
                  variant="success"
                  size="sm"
                  class="float-right"
                  :disabled="pending"
                  v-if="isNew || $app.user.can('edit metas')"
                >
                  {{ isNew ? $t('buttons.create') : $t('buttons.edit') }}
                </b-button>
              </b-col>
            </b-row>
          </b-card>
        </b-col>
      </b-row>
    </form>
  </div>
</template>

<script>
import axios from 'axios'
import form from '../mixins/form'

export default {
  name: 'MetaForm',
  mixins: [form],
  data() {
    return {
      routes: [],
      modelName: 'meta',
      resourceRoute: 'metas',
      listPath: '/metas',
      model: {
        metable_type: null,
        metable_id: null,
        route: null,
        title: null,
        description: null
      }
    }
  },
  created() {
    this.fetchRoutes()
  },
  methods: {
    async fetchRoutes() {
      let { data } = await axios.get(this.$app.route('admin.routes.search'))
      this.routes = data.items
    }
  }
}
</script>
