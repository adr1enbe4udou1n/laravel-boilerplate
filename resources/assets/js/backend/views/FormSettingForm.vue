<template>
  <div class="animated fadeIn">
    <form @submit.prevent="onSubmit">
      <div class="row justify-content-center">
        <div class="col-xl-6">
          <b-card>
            <h4 slot="header">{{ isNew ? $t('labels.backend.form_settings.titles.create') : $t(
              'labels.backend.form_settings.titles.edit')}}</h4>
            <b-form-group
              name="name"
              :label="$t('validation.attributes.form_type')"
              :horizontal="true"
              :label-cols="3"
            >
              <select
                id="name"
                name="name"
                class="custom-select"
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
              name="recipients"
              :label="$t('validation.attributes.recipients')"
              :description="$t('labels.backend.form_settings.descriptions.recipients')"
              :horizontal="true"
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
              name="message"
              :label="$t('validation.attributes.message')"
              :description="$t('labels.backend.form_settings.descriptions.message')"
              :horizontal="true"
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

            <div class="row" slot="footer">
              <div class="col-md-6">
                <b-button to="/form-settings" variant="danger" size="sm">
                  {{ $t('buttons.back') }}
                </b-button>
              </div>
              <div class="col-md-6">
                <b-button type="submit" variant="success" size="sm" class="pull-right"
                          :disabled="pending"
                          v-if="isNew || this.$app.user.can('edit form_settings')">
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
    name: 'form_setting_form',
    mixins: [form],
    data () {
      return {
        formTypes: [
          {
            value: null,
            text: `-- ${this.$t('validation.attributes.form_type')} --`
          }
        ],
        modelName: 'form_setting',
        listPath: '/form-settings',
        model: {
          name: null,
          recipients: null,
          message: null
        }
      }
    },
    created () {
      axios
        .get(this.$app.route(`admin.${this.modelName}s.get_form_types`))
        .then(response => {
          for (let propertyName in response.data) {
            this.formTypes.push({
              value: propertyName,
              text: response.data[propertyName]
            })
          }
        })

      this.fetchData()
    }
  }
</script>
