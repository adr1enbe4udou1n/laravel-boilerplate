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
      <datatable ref="redirectionsDatatable" :options="dataTableOptions" :actions="dataTableActions"
                 action-route-name="admin.redirections.batch_action"></datatable>
    </b-card>
  </div>
</template>

<script>
  import axios from 'axios'
  import toastr from 'toastr'

  export default {
    name: 'redirection_list',
    data () {
      return {
        dataTableOptions: {
          responsive: true,
          serverSide: true,
          processing: true,
          autoWidth: false,
          ajax: {
            url: this.$app.route('admin.redirections.search'),
            type: 'post'
          },
          columns: [
            {
              defaultContent: '',
              title: '',
              data: 'checkbox',
              name: 'checkbox',
              orderable: false,
              searchable: false,
              width: 15,
              className: 'select-checkbox'
            }, {
              title: this.$t('validation.attributes.source_path'),
              data: 'source',
              name: 'source',
              responsivePriority: 1
            }, {
              title: this.$t('validation.attributes.active'),
              data: 'active',
              name: 'active',
              orderable: false,
              width: 50,
              className: 'text-center'
            }, {
              title: this.$t('validation.attributes.target_path'),
              data: 'target',
              name: 'target'
            }, {
              title: this.$t('validation.attributes.redirect_type'),
              data: 'type',
              name: 'type',
              width: 150
            }, {
              title: this.$t('labels.created_at'),
              data: 'created_at',
              name: 'created_at',
              width: 110,
              className: 'text-center'
            }, {
              title: this.$t('labels.updated_at'),
              data: 'updated_at',
              name: 'updated_at',
              width: 110,
              className: 'text-center'
            }, {
              title: this.$t('labels.actions'),
              data: 'actions',
              name: 'actions',
              orderable: false,
              width: 75,
              className: 'nowrap',
              responsivePriority: 2
            }],
          select: {style: 'os'},
          order: [[1, 'asc']],
          rowId: 'id'
        },
        dataTableActions: {
          destroy: this.$t('labels.backend.redirections.actions.destroy'),
          enable: this.$t('labels.backend.redirections.actions.enable'),
          disable: this.$t('labels.backend.redirections.actions.disable')
        },
        importFile: null
      }
    },
    methods: {
      onFileImport () {
        let data = new FormData()
        data.append('import', this.importFile)

        axios
          .post(this.$app.route('admin.redirections.import'), data)
          .then(response => {
            this.$refs.redirectionsDatatable.refresh()
            toastr[response.data.status](response.data.message)
          })
          .catch(() => {
            toastr.error(this.$t('exceptions.general'))
          })
      }
    }
  }
</script>
