<template>
  <div class="animated fadeIn">
    <b-card>
      <template slot="header">
        <div class="float-right mt-2" v-if="this.$app.user.can('create roles')">
          <b-button to="/roles/create" variant="success" size="sm">
            <i class="icon-plus"></i> {{ $t('buttons.roles.create') }}
          </b-button>
        </div>
        <h4 class="mt-1">{{ $t('labels.backend.roles.titles.index') }}</h4>
      </template>
      <b-datatable ref="datasource"
                   @context-changed="onContextChanged"
                   search-route="admin.roles.search"
                   delete-route="admin.roles.destroy"
                   :length-change="false" :paging="false" :infos="false" :search="false">
        <b-table ref="datatable"
                 striped
                 bordered
                 show-empty
                 stacked="md"
                 no-local-sorting
                 :empty-text="$t('labels.datatables.no_results')"
                 :empty-filtered-text="$t('labels.datatables.no_matched_results')"
                 :fields="fields"
                 :items="dataLoadProvider"
                 sort-by="order"
                 :sort-desc="false"
                 :busy.sync="isBusy"
        >
          <template slot="name" slot-scope="row">
            <router-link v-if="row.item.can_edit" :to="`/roles/${row.item.id}/edit`" v-text="row.value"></router-link>
            <span v-else v-text="row.value"></span>
          </template>
          <template slot="actions" slot-scope="row">
            <b-button v-if="row.item.can_edit" size="sm" variant="primary" :to="`/roles/${row.item.id}/edit`" v-b-tooltip.hover :title="$t('buttons.edit')" class="mr-1">
              <i class="icon-pencil"></i>
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
  name: 'RoleList',
  data () {
    return {
      isBusy: false,
      fields: [
        { key: 'name', label: this.$t('validation.attributes.name'), sortable: true },
        { key: 'order', label: this.$t('validation.attributes.order'), 'class': 'text-right', sortable: true },
        { key: 'display_name', label: this.$t('validation.attributes.display_name'), sortable: true },
        { key: 'description', label: this.$t('validation.attributes.description'), sortable: true },
        { key: 'created_at', label: this.$t('labels.created_at'), 'class': 'text-center', sortable: true },
        { key: 'updated_at', label: this.$t('labels.updated_at'), 'class': 'text-center', sortable: true },
        { key: 'actions', label: this.$t('labels.actions'), 'class': 'nowrap' }
      ]
    }
  },
  methods: {
    dataLoadProvider (ctx) {
      return this.$refs.datasource.loadData(ctx.sortBy, ctx.sortDesc)
    },
    onContextChanged () {
      return this.$refs.datatable.refresh()
    },
    onDelete (id) {
      this.$refs.datasource.deleteRow({ role: id })
    }
  }
}
</script>
