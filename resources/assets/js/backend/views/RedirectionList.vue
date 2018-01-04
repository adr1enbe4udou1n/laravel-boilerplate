<template>
  <div class="animated fadeIn">
    <b-row>
      <b-col xl="6">
        <b-card>
          <h4 slot="header">{{ $t('labels.backend.redirections.import.title') }}</h4>
          <form @submit.prevent="onFileImport">
            <b-form-file required :placeholder="$t('labels.no_file_chosen')" :choose-label="$t('labels.choose_file')"
                         v-model="importFile"></b-form-file>
            <b-button type="submit" variant="warning" class="mt-3">
              {{ $t('buttons.redirections.import') }}
            </b-button>
          </form>
        </b-card>
      </b-col>
    </b-row>

    <b-card>
      <template slot="header">
        <div class="pull-right mt-2" v-if="this.$app.user.can('create redirections')">
          <b-button to="/redirections/create" variant="success" size="sm">
            <i class="icon-plus"></i> {{ $t('buttons.redirections.create') }}
          </b-button>
        </div>
        <h4 class="mt-1">{{ $t('labels.backend.redirections.titles.index') }}</h4>
      </template>
      <b-datatable ref="datasource"
                   @context-changed="onContextChanged"
                   search-route="admin.redirections.search"
                   delete-route="admin.redirections.destroy"
                   action-route="admin.redirections.batch_action" :actions="actions"
                   @bulk-action-success="onBulkActionSuccess">
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
                 sort-by="created_at"
                 :sort-desc="true"
                 :busy.sync="isBusy"
        >
          <template slot="HEAD_checkbox" slot-scope="data"></template>
          <template slot="checkbox" slot-scope="row">
            <b-form-checkbox :value="row.item.id" v-model="selected"></b-form-checkbox>
          </template>
          <template slot="active" slot-scope="row">
            <c-switch v-if="row.item.can_edit" type="text" variant="primary" on="On" off="Off" :checked="row.value" @change="onActiveToggle(row.item.id)"></c-switch>
          </template>
          <template slot="actions" slot-scope="row">
            <b-button v-if="row.item.can_edit" size="sm" variant="primary" :to="`/redirections/${row.item.id}/edit`" v-b-tooltip.hover :title="$t('buttons.edit')" class="mr-1">
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
  import axios from 'axios'

  export default {
    name: 'redirection_list',
    data () {
      return {
        isBusy: false,
        selected: [],
        fields: [
          { key: 'checkbox' },
          { key: 'source', label: this.$t('validation.attributes.source_path'), sortable: true },
          { key: 'active', label: this.$t('validation.attributes.active'), 'class': 'text-center' },
          { key: 'target', label: this.$t('validation.attributes.target_path'), sortable: true },
          { key: 'type', label: this.$t('validation.attributes.redirect_type'), 'class': 'text-center' },
          { key: 'created_at', label: this.$t('labels.created_at'), 'class': 'text-center', sortable: true },
          { key: 'updated_at', label: this.$t('labels.updated_at'), 'class': 'text-center', sortable: true },
          { key: 'actions', label: this.$t('labels.actions'), 'class': 'nowrap' }
        ],
        actions: {
          destroy: this.$t('labels.backend.redirections.actions.destroy'),
          enable: this.$t('labels.backend.redirections.actions.enable'),
          disable: this.$t('labels.backend.redirections.actions.disable')
        },
        importFile: null
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
        this.$refs.datasource.deleteRow({ redirection: id })
      },
      onBulkActionSuccess () {
        this.selected = []
      },
      onActiveToggle (id) {
        axios.post(this.$app.route('admin.redirections.active', {redirection: id}))
          .catch((error) => {
            this.$app.error(error)
          })
      },
      onFileImport () {
        let data = new FormData()
        data.append('import', this.importFile)

        axios
          .post(this.$app.route('admin.redirections.import'), data)
          .then((response) => {
            this.$refs.datatable.refresh()
            this.$app.noty[response.data.status](response.data.message)
          })
          .catch((error) => {
            this.$app.error(error)
          })
      }
    },
    watch: {
      selected (value) {
        this.$refs.datasource.selected = value
      }
    }
  }
</script>
