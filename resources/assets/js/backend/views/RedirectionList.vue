<template>
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-xl-6">
                <div class="card">
                    <div class="card-header">
                        <h4>{{ $t('labels.backend.redirections.import.title') }}</h4>
                    </div>
                    <div class="card-body">
                        <form class="form-inline" @submit.prevent="onFileImport">
                            <input
                                    type="file"
                                    class="form-control"
                                    @change="onFileChange"
                            >
                            <input type="submit" class="btn btn-warning btn-md ml-1"
                                   :value="$t('buttons.redirections.import')">
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <div class="pull-right mt-2" v-if="this.$app.user.can('create redirections')">
                    <router-link to="/redirections/create" class="btn btn-success btn-sm"><i class="icon-plus"></i>
                        {{ $t('buttons.redirections.create') }}
                    </router-link>
                </div>
                <h4 class="mt-1">{{ $t('labels.backend.redirections.titles.index') }}</h4>
            </div>
            <div class="card-body">
                <datatable :options="dataTableOptions" :actions="dataTableActions" action-route-name="admin.redirections.batch_action"></datatable>
            </div>
        </div>
    </div>
</template>

<script>
  import axios from 'axios'

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
          columns: [{
            defaultContent: '',
            title: '',
            data: 'checkbox',
            name: 'checkbox',
            orderable: false,
            searchable: false,
            width: 15,
            className: 'select-checkbox'
          }, {
            title: this.$i18n.t('validation.attributes.source_path'),
            data: 'source',
            name: 'source',
            responsivePriority: 1
          }, {
            title: this.$i18n.t('validation.attributes.active'),
            data: 'active',
            name: 'active',
            orderable: false,
            width: 50,
            className: 'text-center'
          }, {
            title: this.$i18n.t('validation.attributes.target_path'),
            data: 'target',
            name: 'target'
          }, {
            title: this.$i18n.t('validation.attributes.redirect_type'),
            data: 'type',
            name: 'type',
            width: 150
          }, {
            title: this.$i18n.t('labels.created_at'),
            data: 'created_at',
            name: 'created_at',
            width: 110,
            className: 'text-center'
          }, {
            title: this.$i18n.t('labels.updated_at'),
            data: 'updated_at',
            name: 'updated_at',
            width: 110,
            className: 'text-center'
          }, {
            title: this.$i18n.t('labels.actions'),
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
          destroy: this.$i18n.t('labels.backend.redirections.actions.destroy'),
          enable: this.$i18n.t('labels.backend.redirections.actions.enable'),
          disable: this.$i18n.t('labels.backend.redirections.actions.disable')
        },
        importFile: null
      }
    },
    methods: {
      onFileChange (e) {
        let files = e.target.files || e.dataTransfer.files
        if (!files.length) return

        this.importFile = files[0]
      },
      onFileImport () {
        let dataTable = $('#dataTableBuilder').DataTable()

        let data = new FormData()
        data.append('import', this.importFile)

        axios
          .post(this.$app.route('admin.redirections.import'), data)
          .then(response => {
            dataTable.ajax.reload(null, false)
            window.toastr[response.data.status](response.data.message)
          })
          .catch(() => {
            window.toastr.error(this.$i18n.t('exceptions.general'))
          })
      }
    }
  }
</script>
