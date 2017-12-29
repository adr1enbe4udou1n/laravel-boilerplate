<template>
  <div class="animated fadeIn">
    <b-card>
      <template slot="header">
        <div class="pull-right mt-2" v-if="this.$app.user.can('create roles')">
          <b-button to="/roles/create" variant="success" size="sm">
            <i class="icon-plus"></i> {{ $t('buttons.roles.create') }}
          </b-button>
        </div>
        <h4 class="mt-1">{{ $t('labels.backend.roles.titles.index') }}</h4>
      </template>
      <b-datatable ref="datatable"
                   @data-loaded="onDataLoaded"
                   search-route="admin.roles.search"
                   delete-route="admin.roles.destroy"
                   :lengthChange="false" :paging="false">
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
            <router-link :to="`/roles/${row.item.id}/edit`">
              {{row.value}}
            </router-link>
          </template>
          <template slot="actions" slot-scope="row">
            <b-button v-if="row.item.can_edit" size="sm" variant="primary" :to="`/roles/${row.item.id}/edit`" v-b-tooltip.hover :title="$t('buttons.edit')" class="mr-1">
              <i class="icon-pencil"></i>
            </b-button>
            <b-button v-if="row.item.can_delete" size="sm" variant="danger" v-b-tooltip.hover :title="$t('buttons.delete')" @click.stop="onDelete(row.value.id)">
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
    name: 'role_list',
    data () {
      return {
        items: [],
        fields: [
          { key: 'name', label: this.$t('validation.attributes.name'), sortable: true },
          { key: 'order', label: this.$t('validation.attributes.order'), 'class': 'text-right', sortable: true },
          { key: 'display_name', label: this.$t('validation.attributes.display_name') },
          { key: 'description', label: this.$t('validation.attributes.description') },
          { key: 'created_at', label: this.$t('labels.created_at'), 'class': 'text-center', sortable: true },
          { key: 'updated_at', label: this.$t('labels.updated_at'), 'class': 'text-center', sortable: true },
          { key: 'actions', label: this.$t('labels.actions') }
        ],
        sortBy: 'order',
        sortDesc: false
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
