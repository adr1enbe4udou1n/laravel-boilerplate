<template>
  <div>
    <b-card>
      <h3 class="card-title" slot="header">
        {{ $t('labels.backend.form_submissions.titles.index') }}
      </h3>
      <b-datatable
        ref="datasource"
        @context-changed="onContextChanged"
        search-route="admin.form_submissions.search"
        delete-route="admin.form_submissions.destroy"
        action-route="admin.form_submissions.batch_action"
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
          sort-by="created_at"
          :sort-desc="true"
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
              :to="`/form-submissions/${row.item.id}/edit`"
              v-text="row.value"
            ></router-link>
            <span v-else v-text="row.value"></span>
          </template>
          <template slot="data" slot-scope="row">
            <div v-for="(value, name) in JSON.parse(row.value)" :key="name">
              <strong>{{ $t(`validation.attributes.${name}`) }}&nbsp;:</strong>
              <span>{{ value }}</span>
            </div>
          </template>
          <template slot="actions" slot-scope="row">
            <b-button
              size="sm"
              variant="success"
              :to="`/form-submissions/${row.item.id}/show`"
              v-b-tooltip.hover
              :title="$t('buttons.show')"
              class="mr-1"
            >
              <i class="fe fe-eye"></i>
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
  name: 'FormSubmissionList',
  data() {
    return {
      selected: [],
      fields: [
        { key: 'checkbox' },
        {
          key: 'type',
          label: this.$t('validation.attributes.form_type'),
          sortable: true
        },
        { key: 'data', label: this.$t('validation.attributes.form_data') },
        {
          key: 'created_at',
          label: this.$t('labels.created_at'),
          class: 'text-center',
          sortable: true
        },
        { key: 'actions', label: this.$t('labels.actions'), class: 'nowrap' }
      ],
      actions: {
        destroy: this.$t('labels.backend.form_submissions.actions.destroy')
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
      this.$refs.datasource.deleteRow({ form_submission: id })
    }
  }
}
</script>
