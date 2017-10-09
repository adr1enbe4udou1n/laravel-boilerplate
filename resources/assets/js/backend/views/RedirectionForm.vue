<template>
    <div class="animated fadeIn">
        <form @submit.prevent="onSubmit">
            <div class="row justify-content-center">
                <div class="col-xl-6">
                    <div class="card">
                        <div class="card-header">
                            <h4>
                                {{ isNew ? $t('labels.backend.redirections.titles.create') : $t('labels.backend.redirections.titles.edit')
                                }}</h4>
                        </div>

                        <div class="card-body">
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
                                <div class="custom-controls-stacked">
                                    <b-form-radio
                                            name="type"
                                            v-validate="'required'"
                                            v-for="(label, type) in redirectionTypes"
                                            :key="type"
                                            v-model="model.type"
                                            :value="type"
                                    >
                                        {{ label }}
                                    </b-form-radio>
                                </div>
                            </b-form-fieldset>
                        </div>

                        <div class="card-footer">
                            <div class="row">
                                <div class="col-md-6">
                                    <router-link to="/redirections" class="btn btn-danger btn-sm">{{ $t('buttons.back')
                                        }}
                                    </router-link>
                                </div>
                                <div class="col-md-6">
                                    <input type="submit" class="btn btn-success btn-sm pull-right"
                                           :value="isNew ? $t('buttons.create') : $t('buttons.edit')"
                                           :disabled="pending"
                                           v-if="isNew || this.$app.user.can('edit redirections')">
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
