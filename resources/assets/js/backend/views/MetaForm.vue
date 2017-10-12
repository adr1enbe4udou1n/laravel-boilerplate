<template>
    <div class="animated fadeIn">
        <form @submit.prevent="onSubmit">
            <div class="row justify-content-center">
                <div class="col-xl-6">
                    <b-card>
                        <h4 slot="header">{{ isNew ? $t('labels.backend.metas.titles.create') : $t('labels.backend.metas.titles.edit')}}</h4>

                        <template v-if="this.model.metable_type !== null">
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label">{{ $t('validation.attributes.metable_type')
                                    }}</label>
                                <div class="col-lg-9">
                                    <label class="col-form-label">{{ $t(`labels.morphs.${this.model.metable_type}`, {'id': this.model.metable_id})
                                        }}</label>
                                </div>
                            </div>
                        </template>
                        <template v-else>
                            <b-form-fieldset
                                    name="route"
                                    :label="$t('validation.attributes.route')"
                                    :horizontal="true"
                                    :label-cols="3"
                                    :invalid-feedback="feedback('route')"
                            >
                                <v-select
                                        id="route"
                                        name="route"
                                        :options="routes"
                                        v-model="model.route"
                                        :placeholder="$t('labels.placeholders.route')"
                                        :on-search="getRoutes"
                                ></v-select>
                            </b-form-fieldset>
                        </template>

                        <b-form-fieldset
                                name="title"
                                :label="$t('validation.attributes.title')"
                                :horizontal="true"
                                :label-cols="3"
                                :invalid-feedback="feedback('title')"
                        >
                            <b-form-input
                                    id="title"
                                    name="title"
                                    :placeholder="$t('validation.attributes.title')"
                                    v-model="model.title"
                            ></b-form-input>
                        </b-form-fieldset>

                        <b-form-fieldset
                                name="description"
                                :label="$t('validation.attributes.description')"
                                :horizontal="true"
                                :label-cols="3"
                                :invalid-feedback="feedback('description')"
                        >
                            <b-form-textarea
                                    id="description"
                                    name="description[meta]"
                                    :rows="5"
                                    :placeholder="$t('validation.attributes.description')"
                                    v-model="model.description"
                            ></b-form-textarea>
                        </b-form-fieldset>

                        <div class="row" slot="footer">
                            <div class="col-md-6">
                                <b-button to="/metas" variant="danger" size="sm">
                                    {{ $t('buttons.back') }}
                                </b-button>
                            </div>
                            <div class="col-md-6">
                                <b-button type="submit" variant="success" size="sm" class="pull-right"
                                          :disabled="pending"
                                          v-if="isNew || this.$app.user.can('edit metas')">
                                    {{ isNew ? $t('buttons.create') : $t('buttons.edit') }}
                                </b-button>
                            </div>
                        </div>
                    </b-card>
                </div>
            </div>
        </form>
    </div>
</template>

<script>
  import axios from 'axios'
  import form from '../mixins/form'

  export default {
    name: 'meta_form',
    mixins: [form],
    data () {
      return {
        routes: [],
        modelName: 'meta',
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
    methods: {
      getRoutes (search) {
        axios
          .get(this.$app.route('admin.routes.search'), {
            params: {
              q: search
            }
          })
          .then(response => {
            this.routes = response.data.items
          })
      }
    }
  }
</script>
