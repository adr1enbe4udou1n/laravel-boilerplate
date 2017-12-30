<template>
  <div class="animated fadeIn">
    <b-card>
      <template slot="header">
        <div class="pull-right mt-2" v-if="this.$app.user.can('create users')">
          <b-button to="/users/create" variant="success" size="sm">
            <i class="icon-plus"></i> {{ $t('buttons.users.create') }}
          </b-button>
        </div>
        <h4 class="mt-1">{{ $t('labels.backend.users.titles.index') }}</h4>
      </template>
      <b-datatable ref="datatable"
                   @data-loaded="onDataLoaded"
                   :sort-by="sortBy"
                   :sort-desc="sortDesc"
                   search-route="admin.users.search"
                   delete-route="admin.users.destroy"
                   action-route="admin.users.batch_action" :actions="actions"
                   @bulk-action-success="onBulkActionSuccess">
        <b-table striped
                 bordered
                 show-empty
                 stacked="md"
                 no-local-sorting
                 :empty-text="$t('labels.datatables.no_results')"
                 :empty-filtered-text="$t('labels.datatables.no_matched_results')"
                 :fields="fields"
                 :items="items"
                 :sort-by="sortBy"
                 :sort-desc="sortDesc"
                 @sort-changed="onSort"
        >
          <template slot="HEAD_checkbox" slot-scope="data"></template>
          <template slot="checkbox" slot-scope="row">
            <b-form-checkbox :value="row.item.id" v-model="selected"></b-form-checkbox>
          </template>
          <template slot="name" slot-scope="row">
            <router-link :to="`/users/${row.item.id}/edit`">
              {{row.value}}
            </router-link>
          </template>
          <template slot="confirmed" slot-scope="row">
            <b-badge :variant="row.value ? 'success' : 'danger'">{{ row.value ? $t('labels.yes') : $t('labels.no') }}</b-badge>
          </template>
          <template slot="active" slot-scope="row">
            <b-badge :variant="row.value ? 'success' : 'danger'">{{ row.value ? $t('labels.yes') : $t('labels.no') }}</b-badge>
          </template>
          <template slot="roles" slot-scope="row">
            {{ formatRoles(row.value) }}
          </template>
          <template slot="actions" slot-scope="row">
            <b-button v-if="row.item.can_edit" size="sm" variant="primary" :to="`/users/${row.item.id}/edit`" v-b-tooltip.hover :title="$t('buttons.edit')" class="mr-1">
              <i class="icon-pencil"></i>
            </b-button>
            <b-button v-if="row.item.can_impersonate" size="sm" variant="warning" :href="`/users/${row.item.id}/login-as`" v-b-tooltip.hover :title="$t('buttons.login-as', { name: row.item.name })" class="mr-1">
              <i class="icon-lock"></i>
            </b-button>
            <b-button v-if="row.item.can_delete" size="sm" variant="danger" v-b-tooltip.hover :title="$t('buttons.delete')" @click.stop="onDelete(row.item.id)">
              <i class="icon-trash"></i>
            </b-button>
          </template>
        </b-table>
      </b-datatable>
    </b-card>
  </div>
</template>

<script>
  export default {
    name: 'user_list',
    data () {
      return {
        items: [],
        selected: [],
        fields: [
          { key: 'checkbox' },
          { key: 'name', label: this.$t('validation.attributes.name'), sortable: true },
          { key: 'email', label: this.$t('validation.attributes.email'), sortable: true },
          { key: 'confirmed', label: this.$t('validation.attributes.confirmed'), 'class': 'text-center' },
          { key: 'roles', label: this.$t('validation.attributes.roles') },
          { key: 'last_access_at', label: this.$t('labels.last_access_at'), 'class': 'text-center', sortable: true },
          { key: 'active', label: this.$t('validation.attributes.active'), 'class': 'text-center' },
          { key: 'created_at', label: this.$t('labels.created_at'), 'class': 'text-center', sortable: true },
          { key: 'updated_at', label: this.$t('labels.updated_at'), 'class': 'text-center', sortable: true },
          { key: 'actions', label: this.$t('labels.actions'), 'class': 'nowrap' }
        ],
        sortBy: 'updated_at',
        sortDesc: true,
        actions: {
          destroy: this.$t('labels.backend.users.actions.destroy'),
          enable: this.$t('labels.backend.users.actions.enable'),
          disable: this.$t('labels.backend.users.actions.disable')
        }
      }
    },
    methods: {
      onDataLoaded (items) {
        this.items = items
      },
      formatRoles (roles) {
        return roles.map((key) => {
          return key.display_name
        }).join(', ')
      },
      onSort (ctx) {
        this.$refs.datatable.sort(ctx.sortBy, ctx.sortDesc)
      },
      onDelete (id) {
        this.$refs.datatable.deleteRow(id)
      },
      onBulkActionSuccess () {
        this.selected = []
      }
    },
    watch: {
      selected (value) {
        this.$refs.datatable.selected = value
      }
    }
  }
</script>
