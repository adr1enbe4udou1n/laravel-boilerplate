<template>
  <div>
    <form @submit.prevent="onSubmit">
      <b-row class="justify-content-center">
        <b-col xl="6">
          <b-card>
            <h3 class="card-title" slot="header">
              {{
                isNew
                  ? $t('labels.backend.form_settings.titles.create')
                  : $t('labels.backend.form_settings.titles.edit')
              }}
            </h3>
            <b-form-group
              :label="$t('validation.attributes.form_type')"
              label-for="name"
              horizontal
              :label-cols="3"
            >
              <select
                id="name"
                name="name"
                class="form-control"
                required
                v-model="model.name"
              >
                <option
                  v-for="type in formTypes"
                  :key="type.value"
                  :value="type.value"
                >
                  {{ type.text }}
                </option>
              </select>
            </b-form-group>

            <b-form-group
              :label="$t('validation.attributes.recipients')"
              label-for="recipients"
              :description="
                $t('labels.backend.form_settings.descriptions.recipients')
              "
              horizontal
              :label-cols="3"
              :feedback="feedback('recipients')"
            >
              <b-form-textarea
                id="recipients"
                name="recipients"
                :rows="5"
                required
                :placeholder="$t('validation.attributes.recipients')"
                v-model="model.recipients"
                :state="state('recipients')"
              ></b-form-textarea>
            </b-form-group>

            <b-form-group
              :label="$t('validation.attributes.message')"
              label-for="message"
              :description="
                $t('labels.backend.form_settings.descriptions.message')
              "
              horizontal
              :label-cols="3"
              :feedback="feedback('message')"
            >
              <b-form-textarea
                id="message"
                name="message"
                :rows="5"
                required
                :placeholder="$t('validation.attributes.message')"
                v-model="model.message"
                :state="state('message')"
              ></b-form-textarea>
            </b-form-group>

            <b-row slot="footer">
              <b-col md>
                <b-button to="/form-settings" exact variant="danger" size="sm">
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
                  v-if="isNew || this.$app.user.can('edit form_settings')"
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
  name: 'FormSettingForm',
  mixins: [form],
  data() {
    return {
      formTypes: [
        {
          value: null,
          text: `-- ${this.$t('validation.attributes.form_type')} --`
        }
      ],
      modelName: 'form_setting',
      resourceRoute: 'form_settings',
      listPath: '/form-settings',
      model: {
        name: null,
        recipients: null,
        message: null
      }
    }
  },
  async created() {
    this.fetchData()

    let { data } = await axios.get(
      this.$app.route(`admin.${this.modelName}s.get_form_types`)
    )

    for (let propertyName in data) {
      this.formTypes.push({
        value: propertyName,
        text: data[propertyName]
      })
    }
  }
}
</script>
