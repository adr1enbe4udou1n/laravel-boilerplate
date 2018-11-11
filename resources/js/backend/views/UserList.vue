<template>
  <div>
    <b-card>
      <template slot="header">
        <h3 class="card-title">
          {{ $t('labels.backend.users.titles.index') }}
        </h3>
        <div class="card-options" v-if="this.$app.user.can('create users')">
          <b-button to="/users/create" variant="success" size="sm">
            <i class="fe fe-plus-circle"></i> {{ $t('buttons.users.create') }}
          </b-button>
        </div>
      </template>
      <b-datatable
        ref="datasource"
        @context-changed="onContextChanged"
        search-route="admin.users.search"
        delete-route="admin.users.destroy"
        action-route="admin.users.batch_action"
        :actions="actions"
        :selected.sync="selected"
      >
        <b-table
          ref="datatable"
          striped
          bordered
          show-empty
          stacked="md"
          no-local-sorting
          :empty-text="$t('labels.datatables.no_results')"
          :empty-filtered-text="$t('labels.datatables.no_matched_results')"
          :fields="fields"
          :items="dataLoadProvider"
        >
          <template slot="HEAD_checkbox" slot-scope="data"></template>
          <template slot="checkbox" slot-scope="row">
            <b-form-checkbox
              :value="row.item.id"
              v-model="selected"
            ></b-form-checkbox>
          </template>
          <template slot="name" slot-scope="row">
            <router-link
              v-if="row.item.can_edit"
              :to="`/users/${row.item.id}/edit`"
              v-text="row.value"
            ></router-link>
            <span v-else v-text="row.value"></span>
          </template>
          <template slot="active" slot-scope="row">
            <c-switch
              v-if="row.item.can_edit"
              :checked="row.value"
              @change="onActiveToggle(row.item.id)"
            ></c-switch>
          </template>
          <template slot="roles" slot-scope="row">
            {{ formatRoles(row.value) }}
          </template>
          <template slot="actions" slot-scope="row">
            <b-button
              v-if="row.item.can_edit"
              size="sm"
              variant="primary"
              :to="`/users/${row.item.id}/edit`"
              v-b-tooltip.hover
              :title="$t('buttons.edit')"
              class="mr-1"
            >
              <i class="fe fe-edit"></i>
            </b-button>
            <b-button
              v-if="row.item.can_impersonate"
              size="sm"
              variant="warning"
              :href="
                $app.route('admin.users.impersonate', { user: row.item.id })
              "
              v-b-tooltip.hover
              :title="$t('buttons.login-as', { name: row.item.name })"
              class="mr-1"
            >
              <i class="fe fe-lock"></i>
            </b-button>
            <b-button
              v-if="row.item.can_delete"
              size="sm"
              variant="danger"
              v-b-tooltip.hover
              :title="$t('buttons.delete')"
              @click.stop="onDelete(row.item.id)"
            >
              <i class="fe fe-trash"></i>
            </b-button>
          </template>
        </b-table>
      </b-datatable>
    </b-card>
  </div>
</template>

<script>
import axios from 'axios'

export default {
  name: 'UserList',
  data() {
    return {
      selected: [],
      fields: [
        { key: 'checkbox' },
        {
          key: 'name',
          label: this.$t('validation.attributes.name'),
          sortable: true
        },
        {
          key: 'email',
          label: this.$t('validation.attributes.email'),
          sortable: true
        },
        { key: 'roles', label: this.$t('validation.attributes.roles') },
        {
          key: 'last_access_at',
          label: this.$t('labels.last_access_at'),
          class: 'text-center',
          sortable: true
        },
        {
          key: 'active',
          label: this.$t('validation.attributes.active'),
          class: 'text-center'
        },
        {
          key: 'created_at',
          label: this.$t('labels.created_at'),
          class: 'text-center',
          sortable: true
        },
        {
          key: 'updated_at',
          label: this.$t('labels.updated_at'),
          class: 'text-center',
          sortable: true
        },
        { key: 'actions', label: this.$t('labels.actions'), class: 'nowrap' }
      ],
      actions: {
        destroy: this.$t('labels.backend.users.actions.destroy'),
        enable: this.$t('labels.backend.users.actions.enable'),
        disable: this.$t('labels.backend.users.actions.disable')
      }
    }
  },
  methods: {
    dataLoadProvider(ctx) {
      return this.$refs.datasource.loadData(ctx.sortBy, ctx.sortDesc)
    },
    onContextChanged() {
      return this.$refs.datatable.refresh()
    },
    onDelete(id) {
      this.$refs.datasource.deleteRow({ user: id })
    },
    onActiveToggle(id) {
      axios
        .post(this.$app.route('admin.users.active', { user: id }))
        .catch(error => {
          this.$app.error(error)
        })
    },
    formatRoles(roles) {
      return roles
        .map(key => {
          return key.display_name
        })
        .join(', ')
    }
  }
}
</script>
