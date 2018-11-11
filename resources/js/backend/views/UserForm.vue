<template>
  <div>
    <form @submit.prevent="onSubmit">
      <b-row class="justify-content-center">
        <b-col xl="6">
          <b-card>
            <h3 class="card-title" slot="header">
              {{
                isNew
                  ? $t('labels.backend.users.titles.create')
                  : $t('labels.backend.users.titles.edit')
              }}
            </h3>

            <b-form-group
              :label="$t('validation.attributes.name')"
              label-for="name"
              horizontal
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
              horizontal
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

            <div class="form-group">
              <b-row>
                <b-col lg="9" offset-lg="3">
                  <c-switch
                    name="active"
                    v-model="model.active"
                    :description="$t('validation.attributes.active')"
                  ></c-switch>
                </b-col>
              </b-row>
            </div>

            <b-form-group
              :label="$t('validation.attributes.password')"
              label-for="password"
              horizontal
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
              horizontal
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
              horizontal
              :label-cols="3"
            >
              <b-form-checkbox-group
                stacked
                v-model="model.roles"
                name="roles[]"
              >
                <b-form-checkbox
                  v-for="role in roles"
                  :key="role.id"
                  v-b-tooltip.left
                  :title="role.description"
                  :value="role.id"
                >
                  {{ role.display_name }}
                </b-form-checkbox>
              </b-form-checkbox-group>
            </b-form-group>

            <b-row slot="footer">
              <b-col>
                <b-button to="/users" exact variant="danger" size="sm">
                  {{ $t('buttons.back') }}
                </b-button>
              </b-col>
              <b-col>
                <b-button
                  type="submit"
                  variant="success"
                  size="sm"
                  class="float-right"
                  :disabled="pending"
                  v-if="isNew || this.$app.user.can('edit users')"
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
  name: 'UserForm',
  mixins: [form],
  data() {
    return {
      roles: [],
      modelName: 'user',
      resourceRoute: 'users',
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
  async created() {
    this.fetchData()
    let { data } = await axios.get(this.$app.route(`admin.users.get_roles`))
    this.roles = data
  },
  methods: {
    onModelChanged() {
      if (this.model.roles) {
        this.model.roles = this.model.roles.map(item => {
          return item.id
        })
      }
    }
  }
}
</script>
