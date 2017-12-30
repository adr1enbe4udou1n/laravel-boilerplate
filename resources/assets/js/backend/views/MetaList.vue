<template>
  <div class="animated fadeIn">
    <b-card>
      <template slot="header">
        <div class="pull-right mt-2" v-if="this.$app.user.can('create metas')">
          <b-button to="/metas/create" variant="success" size="sm">
            <i class="icon-plus"></i> {{ $t('buttons.metas.create') }}
          </b-button>
        </div>
        <h4 class="mt-1">{{ $t('labels.backend.metas.titles.index') }}</h4>
      </template>
      <b-datatable ref="datatable"
                   :sort-by="sortBy"
                   :sort-desc="sortDesc"
                   @data-loaded="onDataLoaded"
                   search-route="admin.metas.search"
                   delete-route="admin.metas.destroy"
                   action-route="admin.metas.batch_action" :actions="actions"
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
          <template slot="actions" slot-scope="row">
            <b-button v-if="row.item.can_edit" size="sm" variant="primary" :to="`/metas/${row.item.id}/edit`" v-b-tooltip.hover :title="$t('buttons.edit')" class="mr-1">
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
    name: 'meta_list',
    data () {
      return {
        items: [],
        selected: [],
        fields: [
          { key: 'checkbox' },
          { key: 'route', label: this.$t('validation.attributes.route'), sortable: true },
          { key: 'metable_type', label: this.$t('validation.attributes.metable_type'), sortable: true },
          { key: 'title', label: this.$t('validation.attributes.title'), sortable: true },
          { key: 'description', label: this.$t('validation.attributes.description') },
          { key: 'created_at', label: this.$t('labels.created_at'), 'class': 'text-center', sortable: true },
          { key: 'updated_at', label: this.$t('labels.updated_at'), 'class': 'text-center', sortable: true },
          { key: 'actions', label: this.$t('labels.actions'), 'class': 'nowrap' }
        ],
        sortBy: 'created_at',
        sortDesc: true,
        actions: {
          destroy: this.$t('labels.backend.metas.actions.destroy')
        }
      }
    },
    methods: {
      onDataLoaded (items) {
        this.items = items
      },
      onSort (ctx) {
        this.$refs.datatable.sort(ctx.sortBy, ctx.sortDesc)
      },
      onDelete (id) {
        this.$refs.datatable.deleteRow({ meta: id })
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
