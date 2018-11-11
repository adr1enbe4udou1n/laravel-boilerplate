<template>
  <div>
    <b-card>
      <template slot="header">
        <h3 class="card-title">
          {{ $t('labels.backend.form_settings.titles.index') }}
        </h3>
        <div
          class="card-options"
          v-if="this.$app.user.can('create form_settings')"
        >
          <b-button to="/form-settings/create" variant="success" size="sm">
            <i class="fe fe-plus-circle"></i>
            {{ $t('buttons.form_settings.create') }}
          </b-button>
        </div>
      </template>
      <b-datatable
        ref="datasource"
        @context-changed="onContextChanged"
        search-route="admin.form_settings.search"
        delete-route="admin.form_settings.destroy"
        :length-change="false"
        :paging="false"
        :infos="false"
        :search="false"
        :export-data="false"
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
          sort-by="name"
          :sort-desc="false"
        >
          <template slot="name" slot-scope="row">
            <router-link
              v-if="row.item.can_edit"
              :to="`/form-settings/${row.item.id}/edit`"
              v-text="row.value"
            ></router-link>
            <span v-else v-text="row.value"></span>
          </template>
          <template slot="actions" slot-scope="row">
            <b-button
              v-if="row.item.can_edit"
              size="sm"
              variant="primary"
              :to="`/form-settings/${row.item.id}/edit`"
              v-b-tooltip.hover
              :title="$t('buttons.edit')"
              class="mr-1"
            >
              <i class="fe fe-edit"></i>
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
export default {
  name: 'FormSettingList',
  data() {
    return {
      fields: [
        {
          key: 'name',
          label: this.$t('validation.attributes.form_type'),
          sortable: true
        },
        {
          key: 'recipients',
          label: this.$t('validation.attributes.recipients')
        },
        { key: 'message', label: this.$t('validation.attributes.message') },
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
      ]
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
      this.$refs.datasource.deleteRow({ form_setting: id })
    }
  }
}
</script>
