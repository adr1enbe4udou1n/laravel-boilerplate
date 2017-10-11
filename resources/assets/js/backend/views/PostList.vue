<template>
    <div class="animated fadeIn">
        <b-card>
            <template slot="header">
                <div class="pull-right mt-2" v-if="this.$app.user.can('create posts')">
                    <router-link to="/posts/create" class="btn btn-success btn-sm"><i class="icon-plus"></i>
                        {{ $t('buttons.posts.create') }}
                    </router-link>
                </div>
                <h4 class="mt-1">{{ $t('labels.backend.posts.titles.index') }}</h4>
            </template>
            <datatable :options="dataTableOptions" :actions="dataTableActions" action-route-name="admin.posts.batch_action"></datatable>
        </b-card>
    </div>
</template>

<script>
  export default {
    name: 'post_list',
    data () {
      return {
        dataTableOptions: {
          responsive: true,
          serverSide: true,
          processing: true,
          autoWidth: false,
          ajax: {
            url: this.$app.route('admin.posts.search'),
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
            title: this.$t('validation.attributes.image'),
            data: 'image',
            name: 'image',
            orderable: false,
            searchable: false,
            width: 120
          }, {
            title: this.$t('validation.attributes.title'),
            data: 'title',
            name: 'translations.title',
            defaultContent: this.$t('labels.no_value'),
            responsivePriority: 1
          }, {
            title: this.$t('validation.attributes.status'),
            data: 'status',
            name: 'status',
            searchable: false,
            className: 'text-center',
            width: 75,
            responsivePriority: 2
          }, {
            title: this.$t('validation.attributes.pinned'),
            data: 'pinned',
            name: 'pinned',
            searchable: false,
            className: 'text-center',
            width: 50
          }, {
            title: this.$t('validation.attributes.promoted'),
            data: 'promoted',
            name: 'promoted',
            searchable: false,
            className: 'text-center',
            width: 90
          }, {
            title: this.$t('labels.author'),
            data: 'owner.name',
            name: 'owner.name',
            orderable: false,
            width: 100,
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
            responsivePriority: 3
          }],
          select: {style: 'os'},
          order: [[9, 'desc']],
          rowId: 'id'
        },
        dataTableActions: {
          destroy: this.$t('labels.backend.posts.actions.destroy'),
          publish: this.$t('labels.backend.posts.actions.publish'),
          pin: this.$t('labels.backend.posts.actions.pin'),
          promote: this.$t('labels.backend.posts.actions.promote')
        }
      }
    }
  }
</script>
