<template>
    <div class="animated fadeIn">
        <form @submit.prevent="onSubmit">
            <div class="row justify-content-center">
                <div class="col-xl-6">
                    <b-card>
                        <h4 class="header">{{ isNew ? $t('labels.backend.redirections.titles.create') : $t('labels.backend.redirections.titles.edit')}}</h4>

                        <b-form-fieldset
                                name="source"
                                :label="$t('validation.attributes.source_path')"
                                :horizontal="true"
                                :label-cols="3"
                                :invalid-feedback="feedback('source')"
                        >
                            <input
                                    id="source"
                                    name="source"
                                    v-validate="'required'"
                                    :placeholder="$t('validation.attributes.source_path')"
                                    class="form-control"
                                    v-model="model.source"
                            >
                        </b-form-fieldset>

                        <b-form-fieldset
                                name="active"
                                :label="$t('validation.attributes.active')"
                                :horizontal="true"
                                :label-cols="3"
                        >
                            <c-switch
                                    name="active"
                                    type="text"
                                    variant="primary"
                                    on="On"
                                    off="Off"
                                    v-model="model.active"
                            ></c-switch>
                        </b-form-fieldset>

                        <b-form-fieldset
                                name="target"
                                :label="$t('validation.attributes.target_path')"
                                :horizontal="true"
                                :label-cols="3"
                                :invalid-feedback="feedback('target')"
                        >
                            <input
                                    id="target"
                                    name="target"
                                    v-validate="'required'"
                                    :placeholder="$t('validation.attributes.target_path')"
                                    class="form-control"
                                    v-model="model.target"
                            >
                        </b-form-fieldset>

                        <b-form-fieldset
                                :label="$t('validation.attributes.redirect_type')"
                                :horizontal="true"
                                :label-cols="3"
                        >
                            <b-form-radio-group stacked v-model="model.type" :options="redirectionTypes" name="type" v-validate="'required'">
                            </b-form-radio-group>
                        </b-form-fieldset>

                        <div class="row" slot="footer">
                            <div class="col-md-6">
                                <b-button to="/redirections" variant="danger" size="sm">
                                    {{ $t('buttons.back') }}
                                </b-button>
                            </div>
                            <div class="col-md-6">
                                <b-button type="submit" variant="success" size="sm" class="pull-right"
                                          :disabled="pending"
                                          v-if="isNew || this.$app.user.can('edit redirections')">
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
    name: 'redirection_form',
    mixins: [form],
    data () {
      return {
        redirectionTypes: {},
        modelName: 'redirection',
        listPath: '/redirections',
        model: {
          source: null,
          active: true,
          target: null,
          type: 301
        }
      }
    },
    created () {
      axios
        .get(this.$app.route(`admin.redirections.get_redirection_types`))
        .then(response => {
          this.redirectionTypes = response.data
        })

      this.fetchData()
    }
  }
</script>
