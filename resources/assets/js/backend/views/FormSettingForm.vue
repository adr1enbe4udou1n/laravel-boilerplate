<template>
    <div class="animated fadeIn">
        <form @submit.prevent="onSubmit">
            <div class="row justify-content-center">
                <div class="col-xl-6">
                    <div class="card">
                        <div class="card-header">
                            <h4>
                                {{ isNew ? $t('labels.backend.form_settings.titles.create') : $t('labels.backend.form_settings.titles.edit')
                                }}</h4>
                        </div>

                        <div class="card-body">
                            <b-form-fieldset
                                    name="name"
                                    :label="$t('validation.attributes.form_type')"
                                    :horizontal="true"
                                    :label-cols="3"
                            >
                                <select
                                        id="name"
                                        name="name"
                                        class="form-control"
                                        v-validate="'required'"
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
                            </b-form-fieldset>

                            <b-form-fieldset
                                    name="recipients"
                                    :label="$t('validation.attributes.recipients')"
                                    :description="$t('labels.backend.form_settings.descriptions.recipients')"
                                    :horizontal="true"
                                    :label-cols="3"
                                    :invalid-feedback="feedback('recipients')"
                            >
                                <textarea
                                        id="recipients"
                                        name="recipients"
                                        :rows="5"
                                        v-validate="'required'"
                                        :placeholder="$t('validation.attributes.recipients')"
                                        class="form-control"
                                        v-model="model.recipients"
                                ></textarea>
                            </b-form-fieldset>

                            <b-form-fieldset
                                    name="message"
                                    :label="$t('validation.attributes.message')"
                                    :description="$t('labels.backend.form_settings.descriptions.message')"
                                    :horizontal="true"
                                    :label-cols="3"
                                    :invalid-feedback="feedback('message')"
                            >
                                <textarea
                                        id="message"
                                        name="message"
                                        :rows="5"
                                        v-validate="'required'"
                                        :placeholder="$t('validation.attributes.message')"
                                        class="form-control"
                                        v-model="model.message"
                                ></textarea>
                            </b-form-fieldset>
                        </div>

                        <div class="card-footer">
                            <div class="row">
                                <div class="col-md-6">
                                    <router-link to="/form-settings" class="btn btn-danger btn-sm">{{ $t('buttons.back')
                                        }}
                                    </router-link>
                                </div>
                                <div class="col-md-6">
                                    <input type="submit" class="btn btn-success btn-sm pull-right"
                                           :value="isNew ? $t('buttons.create') : $t('buttons.edit')"
                                           :disabled="pending">
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
            text: `-- ${this.$i18n.t('validation.attributes.form_type')} --`
          }
        ],
        modelName: 'form_setting',
        listPath: '/form-setting',
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
