<template>
    <div class="animated fadeIn">
        <b-card>
            <template slot="header">
                <div class="pull-right mt-2" v-if="this.$app.user.can('create metas')">
                    <b-button to="/metas/create" variant="success" size="sm">
                        <i class="icon-plus"></i> {{ $t('buttons.metas.create') }}
                    </b-button>
                </div>
                <h4 class="mt-1">{{ $t('labels.backend.metas.titles.index') }}</h4>
            </template>
            <datatable :options="dataTableOptions" :actions="dataTableActions" action-route-name="admin.metas.batch_action"></datatable>
        </b-card>
    </div>
</template>

<script>
  export default {
    name: 'meta_list',
    data () {
      return {
        dataTableOptions: {
          responsive: true,
          serverSide: true,
          processing: true,
          autoWidth: false,
          ajax: {
            url: this.$app.route('admin.metas.search'),
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
            title: this.$t('validation.attributes.route'),
            data: 'route',
            name: 'route',
            defaultContent: this.$t('labels.no_value'),
            width: 75
          }, {
            title: this.$t('validation.attributes.metable_type'),
            data: 'metable_type',
            name: 'metable_type',
            defaultContent: this.$t('labels.no_value'),
            width: 75
          }, {
            title: this.$t('validation.attributes.title'),
            data: 'title',
            name: 'translations.title',
            defaultContent: this.$t('labels.no_value'),
            width: 150,
            responsivePriority: 1
          }, {
            title: this.$t('validation.attributes.description'),
            data: 'description',
            name: 'translations.description',
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
          select: {style: 'os'},
          order: [[5, 'desc']],
          rowId: 'id'
        },
        dataTableActions: {
          destroy: this.$t('labels.backend.metas.actions.destroy')
        }
      }
    }
  }
</script>
