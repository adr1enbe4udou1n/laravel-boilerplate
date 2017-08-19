<template>
    <div class="animated fadeIn">
        <div class="card">
            <div class="card-header">
                <div class="pull-right mt-2">
                    <router-link to="/role/create" class="btn btn-success btn-sm">
                        <i class="icon-plus"></i> {{ $t('buttons.roles.create') }}
                    </router-link>
                </div>
                <h4 class="mt-1">{{ $t('labels.backend.roles.titles.index') }}</h4>
            </div>
            <div class="card-body">
                <table id="dataTableBuilder" class="table table-striped table-bordered table-hover" cellspacing="0"
                       width="100%"></table>
            </div>
        </div>
    </div>
</template>

<script>
  export default {
    name: 'role_list',
    mounted () {
      $('#dataTableBuilder').DataTable({
        responsive: true,
        serverSide: true,
        processing: true,
        autoWidth: false,
        lengthChange: false,
        searching: false,
        paging: false,
        info: false,
        buttons: [],
        ajax: {
          url: this.$app.route('admin.role.search'),
          type: 'post'
        },
        columns: [{
          title: this.$i18n.t('validation.attributes.name'),
          data: 'name',
          name: 'name',
          orderable: false,
          width: 150,
          responsivePriority: 1
        }, {
          title: this.$i18n.t('validation.attributes.order'),
          data: 'order',
          name: 'order',
          width: 120,
          className: 'text-right'
        }, {
          title: this.$i18n.t('validation.attributes.display_name'),
          data: 'display_name',
          name: 'display_name',
          defaultContent: this.$i18n.t('labels.no_value'),
          orderable: false,
          width: 150
        }, {
          title: this.$i18n.t('validation.attributes.description'),
          data: 'description',
          name: 'description',
          defaultContent: this.$i18n.t('labels.no_value'),
          orderable: false
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
        order: [[1, 'asc']]
      })
    }
  }
</script>
