<template>
  <div class="animated fadeIn">
    <form @submit.prevent="onSubmit">
      <b-row class="justify-content-center">
        <b-col xl="6">
          <b-card>
            <h4 slot="header">{{ isNew ? $t('labels.backend.users.titles.create') : $t('labels.backend.users.titles.edit') }}</h4>

            <b-form-group
              :label="$t('validation.attributes.name')"
              label-for="name"
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
              :label="$t('validation.attributes.email')"
              label-for="email"
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
              :label="$t('validation.attributes.password')"
              label-for="password"
              :horizontal="true"
              :label-cols="3"
              :feedback="feedback('password')"
            >
              <b-form-input
                id="password"
                name="password"
                type="password"
                :placeholder="$t('validation.attributes.password')"
                v-model="model.password"
                :state="state('password')"
              ></b-form-input>
            </b-form-group>

            <b-form-group
              :label="$t('validation.attributes.password_confirmation')"
              label-for="password_confirmation"
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
              label-for="roles"
              :horizontal="true"
              :label-cols="3"
            >
              <b-form-checkbox-group stacked id="roles">
                <div class="custom-control custom-checkbox" v-for="role in roles" :key="role.id"
                     v-b-tooltip.left :title="role.description">
                  <input type="checkbox" class="custom-control-input" name="roles[]" :id="`role${role.id}`" :value="role.id" v-model="model.roles">
                  <label class="custom-control-label" :for="`role${role.id}`">{{ role.display_name }}</label>
                </div>
              </b-form-checkbox-group>
            </b-form-group>

            <b-row slot="footer">
              <b-col>
                <b-button to="/users" variant="danger" size="sm">
                  {{ $t('buttons.back') }}
                </b-button>
              </b-col>
              <b-col>
                <b-button type="submit" variant="success" size="sm" class="pull-right"
                          :disabled="pending"
                          v-if="isNew || this.$app.user.can('edit users')">
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
  name: 'UserForm',
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
      .then((response) => {
        this.roles = response.data
      })

    this.fetchData()
  },
  methods: {
    onModelChanged () {
      if (this.model.roles) {
        this.model.roles = this.model.roles.map((item) => {
          return item.id
        })
      }
    }
  }
}
</script>
