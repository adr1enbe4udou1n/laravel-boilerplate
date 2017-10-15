<template>
  <div class="animated fadeIn">
    <b-card>
      <template slot="header">
        <div class="pull-right mt-2" v-if="this.$app.user.can('create form_settings')">
          <b-button to="/form-settings/create" variant="success" size="sm">
            <i class="icon-plus"></i> {{ $t('buttons.form_settings.create') }}
          </b-button>
        </div>
        <h4 class="mt-1">{{ $t('labels.backend.form_settings.titles.index') }}</h4>
      </template>
      <datatable :options="dataTableOptions"></datatable>
    </b-card>
  </div>
</template>

<script>
  export default {
    name: 'form_setting_list',
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
            url: this.$app.route('admin.form_settings.search'),
            type: 'post'
          },
          columns: [
            {
              title: this.$t('validation.attributes.form_type'),
              data: 'name',
              name: 'name',
              width: 150,
              responsivePriority: 1
            }, {
              title: this.$t('validation.attributes.recipients'),
              data: 'recipients',
              name: 'recipients',
              orderable: false
            }, {
              title: this.$t('validation.attributes.message'),
              data: 'message',
              name: 'message',
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
          order: [[0, 'asc']],
          rowId: 'id'
        }
      }
    }
  }
</script>
