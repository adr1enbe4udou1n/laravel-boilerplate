<template>
    <div class="animated fadeIn">
        <form @submit.prevent="onSubmit">
            <div class="row justify-content-center">
                <div class="col-xl-6">
                    <b-card>
                        <h4 slot="header">{{ isNew ? $t('labels.backend.users.titles.create') : $t('labels.backend.users.titles.edit')}}</h4>

                        <b-form-group
                                name="name"
                                :label="$t('validation.attributes.name')"
                                :horizontal="true"
                                :label-cols="3"
                                :feedback="feedback('name')"
                        >
                            <b-form-input
                                    id="name"
                                    name="name"
                                    required
                                    :placeholder="$t('validation.attributes.name')"
                                    v-model="model.name"
                                    :state="state('name')"
                            ></b-form-input>
                        </b-form-group>

                        <b-form-group
                                name="email"
                                :label="$t('validation.attributes.email')"
                                :horizontal="true"
                                :label-cols="3"
                                :feedback="feedback('email')"
                        >
                            <b-form-input
                                    id="email"
                                    name="email"
                                    type="email"
                                    required
                                    :placeholder="$t('validation.attributes.email')"
                                    v-model="model.email"
                                    :state="state('email')"
                            ></b-form-input>
                        </b-form-group>

                        <b-form-group
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
                        </b-form-group>

                        <b-form-group
                                name="password"
                                :label="$t('validation.attributes.password')"
                                :horizontal="true"
                                :label-cols="3"
                                :feedback="feedback('password')"
                        >
                            <b-form-input
                                    id="password"
                                    name="password"
                                    type="password"
                                    :placeholder="$t('validation.attributes.password')"
                                    data-toggle="password-strength-meter"
                                    v-model="model.password"
                                    :state="state('password')"
                            ></b-form-input>
                        </b-form-group>

                        <b-form-group
                                name="password_confirmation"
                                :label="$t('validation.attributes.password_confirmation')"
                                :horizontal="true"
                                :label-cols="3"
                                :feedback="feedback('password_confirmation')"
                        >
                            <b-form-input
                                    id="password_confirmation"
                                    name="password_confirmation"
                                    type="password"
                                    :placeholder="$t('validation.attributes.password_confirmation')"
                                    v-model="model.password_confirmation"
                                    :state="state('password_confirmation')"
                            ></b-form-input>
                        </b-form-group>

                        <b-form-group
                                :label="$t('validation.attributes.roles')"
                                :horizontal="true"
                                :label-cols="3"
                        >
                            <b-form-checkbox-group stacked v-model="model.roles" name="roles[]">
                                <b-form-checkbox v-for="role in roles" :key="role.id"
                                                 v-b-tooltip.left :title="role.description" :value="role.id">
                                    {{ role.display_name }}
                                </b-form-checkbox>
                            </b-form-checkbox-group>
                        </b-form-group>

                        <div class="row" slot="footer">
                            <div class="col-md-6">
                                <b-button to="/users" variant="danger" size="sm">
                                    {{ $t('buttons.back') }}
                                </b-button>
                            </div>
                            <div class="col-md-6">
                                <b-button type="submit" variant="success" size="sm" class="pull-right"
                                          :disabled="pending"
                                          v-if="isNew || this.$app.user.can('edit users')">
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
          this.roles = response.data
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
