<template>
  <div class="animated fadeIn">
    <b-card>
      <h4 slot="header">{{ $t('labels.backend.form_submissions.titles.index') }}</h4>
      <b-datatable ref="datatable"
                   @data-loaded="onDataLoaded"
                   search-route="admin.form_submissions.search"
                   delete-route="admin.form_submissions.destroy"
                   action-route="admin.form_submissions.batch_action" :actions="actions">
        <b-table striped
                 bordered
                 show-empty
                 stacked="md"
                 no-local-sorting
                 :empty-text="$t('labels.no_results')"
                 :empty-filtered-text="$t('labels.no_results')"
                 :fields="fields"
                 :items="items"
                 :sort-by="sortBy"
                 :sort-desc="sortDesc"
                 @sort-changed="onSort"
        >
          <template slot="name" slot-scope="row">
            <router-link :to="`/form-submissions/${row.item.id}/edit`">
              {{row.value}}
            </router-link>
          </template>
          <template slot="actions" slot-scope="row">
            <b-button size="sm" variant="success" :to="`/form-submissions/${row.item.id}/show`" v-b-tooltip.hover :title="$t('buttons.show')" class="mr-1">
              <i class="icon-eye"></i>
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
    name: 'form_submission_list',
    data () {
      return {
        items: [],
        fields: [
          { key: 'type', label: this.$t('validation.attributes.form_type'), sortable: true },
          { key: 'data', label: this.$t('validation.attributes.form_data') },
          { key: 'created_at', label: this.$t('labels.created_at'), 'class': 'text-center', sortable: true },
          { key: 'actions', label: this.$t('labels.actions'), 'class': 'nowrap' }
        ],
        sortBy: 'created_at',
        sortDesc: true,
        actions: {
          destroy: this.$t('labels.backend.form_submissions.actions.destroy')
        }
      }
    },
    mounted () {
      this.$refs.datatable.refresh(this.sortBy, this.sortDesc)
    },
    methods: {
      onDataLoaded (items) {
        this.items = items
      },
      onSort (ctx) {
        this.$refs.datatable.refresh(ctx.sortBy, ctx.sortDesc)
      },
      onDelete (id) {
        this.$refs.datatable.deleteRow(id)
      }
    }
  }
</script>
