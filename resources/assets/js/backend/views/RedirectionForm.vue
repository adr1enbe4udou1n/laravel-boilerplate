<template>
  <div class="animated fadeIn">
    <form @submit.prevent="onSubmit">
      <b-row class="justify-content-center">
        <b-col xl="6">
          <b-card>
            <h4 slot="header">{{ isNew ? $t('labels.backend.redirections.titles.create') : $t('labels.backend.redirections.titles.edit') }}</h4>

            <b-form-group
              :label="$t('validation.attributes.source_path')"
              label-for="source"
              :horizontal="true"
              :label-cols="3"
              :feedback="feedback('source')"
            >
              <b-form-input
                id="source"
                name="source"
                required
                :placeholder="$t('validation.attributes.source_path')"
                v-model="model.source"
                :state="state('source')"
              ></b-form-input>
            </b-form-group>

            <b-form-group
              :label="$t('validation.attributes.active')"
              label-for="active"
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
            </b-form-group>

            <b-form-group
              :label="$t('validation.attributes.target_path')"
              label-for="target"
              :horizontal="true"
              :label-cols="3"
              :feedback="feedback('target')"
            >
              <b-form-input
                id="target"
                name="target"
                required
                :placeholder="$t('validation.attributes.target_path')"
                v-model="model.target"
                :state="state('target')"
              ></b-form-input>
            </b-form-group>

            <b-form-group
              :label="$t('validation.attributes.redirect_type')"
              label-for="type"
              :horizontal="true"
              :label-cols="3"
            >
              <b-form-radio-group stacked v-model="model.type" :options="redirectionTypes" name="type" required>
              </b-form-radio-group>
            </b-form-group>

            <b-row slot="footer">
              <b-col md>
                <b-button to="/redirections" variant="danger" size="sm">
                  {{ $t('buttons.back') }}
                </b-button>
              </b-col>
              <b-col md>
                <b-button type="submit" variant="success" size="sm" class="pull-right"
                          :disabled="pending"
                          v-if="isNew || this.$app.user.can('edit redirections')">
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
  name: 'RedirectionForm',
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
  async created () {
    this.fetchData()

    let {data} = await axios.get(this.$app.route(`admin.redirections.get_redirection_types`))
    this.redirectionTypes = data
  }
}
</script>
