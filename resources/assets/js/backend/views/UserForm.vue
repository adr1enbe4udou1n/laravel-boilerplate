<template>
    <div class="animated fadeIn">
        <form @submit.prevent="onSubmit">
            <div class="row justify-content-center">
                <div class="col-xl-6">
                    <b-card>
                        <h4 slot="header">{{ isNew ? $t('labels.backend.users.titles.create') : $t('labels.backend.users.titles.edit')}}</h4>

                        <b-form-fieldset
                                name="name"
                                :label="$t('validation.attributes.name')"
                                :horizontal="true"
                                :label-cols="3"
                                :invalid-feedback="feedback('name')"
                        >
                            <input
                                    id="name"
                                    name="name"
                                    :placeholder="$t('validation.attributes.name')"
                                    class="form-control"
                                    v-model="model.name"
                                    v-validate="'required'"
                            >
                        </b-form-fieldset>

                        <b-form-fieldset
                                name="email"
                                :label="$t('validation.attributes.email')"
                                :horizontal="true"
                                :label-cols="3"
                                :invalid-feedback="feedback('email')"
                        >
                            <input
                                    id="email"
                                    name="email"
                                    type="email"
                                    :placeholder="$t('validation.attributes.email')"
                                    class="form-control"
                                    v-model="model.email"
                                    v-validate="'required|email'"
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
                                name="password"
                                :label="$t('validation.attributes.password')"
                                :horizontal="true"
                                :label-cols="3"
                                :invalid-feedback="feedback('password')"
                        >
                            <input
                                    id="password"
                                    name="password"
                                    type="password"
                                    :placeholder="$t('validation.attributes.password')"
                                    class="form-control"
                                    data-toggle="password-strength-meter"
                                    v-model="model.password"
                            >
                        </b-form-fieldset>

                        <b-form-fieldset
                                name="password_confirmation"
                                :label="$t('validation.attributes.password_confirmation')"
                                :horizontal="true"
                                :label-cols="3"
                                :invalid-feedback="feedback('password_confirmation')"
                        >
                            <input
                                    id="password_confirmation"
                                    name="password_confirmation"
                                    type="password"
                                    :placeholder="$t('validation.attributes.password_confirmation')"
                                    class="form-control"
                                    v-model="model.password_confirmation"
                            >
                        </b-form-fieldset>

                        <b-form-fieldset
                                :label="$t('validation.attributes.roles')"
                                :horizontal="true"
                                :label-cols="3"
                        >
                            <b-form-checkbox-group stacked v-model="model.roles" name="roles[]" :options="roles">
                            </b-form-checkbox-group>
                        </b-form-fieldset>

                        <div class="row" slot="footer">
                            <div class="col-md-6">
                                <router-link to="/users" class="btn btn-danger btn-sm">{{ $t('buttons.back') }}
                                </router-link>
                            </div>
                            <div class="col-md-6">
                                <input type="submit" class="btn btn-success btn-sm pull-right"
                                       :value="isNew ? $t('buttons.create') : $t('buttons.edit')"
                                       :disabled="pending"
                                       v-if="isNew || this.$app.user.can('edit users')">
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
  import 'pwstrength-bootstrap/dist/pwstrength-bootstrap'

  export default {
    name: 'user_form',
    mixins: [form],
    data () {
      return {
        roles: [],
        modelName: 'user',
        listPath: '/users',
        model: {
          name: null,
          email: null,
          active: true,
          password: null,
          confirm_password: null,
          roles: []
        }
      }
    },
    created () {
      axios
        .get(this.$app.route(`admin.users.get_roles`))
        .then(response => {
          response.data.forEach((element) => {
            this.roles.push({
              value: element.id,
              text: element.display_name
            })
          })
        })

      this.fetchData()
    },
    mounted () {
      $('#password').pwstrength({
        ui: {
          bootstrap4: true
        }
      })
    }
  }
</script>
