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
            <datatable :options="dataTableOptions"></datatable>
        </b-card>
    </div>
</template>

<script>
  export default {
    name: 'role_list',
    data () {
      return {
        dataTableOptions: {
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
            url: this.$app.route('admin.roles.search'),
            type: 'post'
          },
          columns: [{
            title: this.$t('validation.attributes.name'),
            data: 'name',
            name: 'name',
            orderable: false,
            width: 150,
            responsivePriority: 1
          }, {
            title: this.$t('validation.attributes.order'),
            data: 'order',
            name: 'order',
            width: 120,
            className: 'text-right'
          }, {
            title: this.$t('validation.attributes.display_name'),
            data: 'display_name',
            name: 'display_name',
            defaultContent: this.$t('labels.no_value'),
            orderable: false,
            width: 150
          }, {
            title: this.$t('validation.attributes.description'),
            data: 'description',
            name: 'description',
            defaultContent: this.$t('labels.no_value'),
            orderable: false
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
          order: [[1, 'asc']]
        }
      }
    }
  }
</script>
