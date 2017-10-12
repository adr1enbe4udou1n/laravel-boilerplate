<template>
    <div class="animated fadeIn">
        <b-card>
            <template slot="header">
                <div class="pull-right mt-2" v-if="this.$app.user.can('create users')">
                    <b-button to="/users/create" variant="success" size="sm">
                        <i class="icon-plus"></i> {{ $t('buttons.users.create') }}
                    </b-button>
                </div>
                <h4 class="mt-1">{{ $t('labels.backend.users.titles.index') }}</h4>
            </template>
            <datatable :options="dataTableOptions" :actions="dataTableActions" action-route-name="admin.users.batch_action"></datatable>
        </b-card>
    </div>
</template>

<script>
  export default {
    name: 'user_list',
    data () {
      return {
        dataTableOptions: {
          responsive: true,
          serverSide: true,
          processing: true,
          autoWidth: false,
          ajax: {
            url: this.$app.route('admin.users.search'),
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
            title: this.$t('validation.attributes.name'),
            data: 'name',
            name: 'name',
            width: 150,
            responsivePriority: 1
          }, {
            title: this.$t('validation.attributes.email'),
            data: 'email',
            name: 'email',
            width: 150
          }, {
            title: this.$t('validation.attributes.confirmed'),
            data: 'confirmed',
            name: 'confirmed',
            orderable: false,
            searchable: false,
            width: 75,
            className: 'text-center'
          }, {
            title: this.$t('validation.attributes.roles'),
            data: 'roles',
            name: 'roles',
            orderable: false,
            searchable: false
          }, {
            title: this.$t('labels.last_access_at'),
            data: 'last_access_at',
            name: 'last_access_at',
            width: 125,
            className: 'text-center'
          }, {
            title: this.$t('validation.attributes.active'),
            data: 'active',
            name: 'active',
            orderable: false,
            searchable: false,
            width: 50,
            className: 'text-center'
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
            width: 100,
            className: 'nowrap',
            responsivePriority: 2
          }],
          select: {style: 'os'},
          order: [[7, 'desc']],
          rowId: 'id'
        },
        dataTableActions: {
          destroy: this.$t('labels.backend.users.actions.destroy'),
          enable: this.$t('labels.backend.users.actions.enable'),
          disable: this.$t('labels.backend.users.actions.disable')
        }
      }
    }
  }
</script>
