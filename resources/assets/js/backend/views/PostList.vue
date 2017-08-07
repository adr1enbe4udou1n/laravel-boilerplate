<template>
    <div class="animated fadeIn">
        <div class="card">
            <div class="card-header">
                <div class="pull-right mt-2">
                    <router-link to="/post/create" class="btn btn-success btn-sm"><i class="icon-plus"></i>
                        {{ $t('buttons.posts.create') }}
                    </router-link>
                </div>
                <h4 class="mt-1">{{ $t('labels.backend.posts.titles.index') }}</h4>
            </div>
            <div class="card-block">
                <table id="dataTableBuilder" class="table table-striped table-bordered table-hover" cellspacing="0"
                       width="100%"></table>
                <batch-action :options="options" :url="`${this.$root.adminPath}/post/batch-action`" datatable="dataTableBuilder"></batch-action>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'post_list',
        props: ['adminPath'],
        data() {
            return {
                options: {
                    destroy: this.$i18n.t('labels.backend.posts.actions.destroy'),
                    publish: this.$i18n.t('labels.backend.posts.actions.publish'),
                    pin: this.$i18n.t('labels.backend.posts.actions.pin'),
                    promote: this.$i18n.t('labels.backend.posts.actions.promote'),
                }
            };
        },
        mounted() {
            $('#dataTableBuilder').DataTable({
                serverSide: true,
                processing: true,
                ajax: {
                    url: `${this.$root.adminPath}/post/search`,
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
                    title: this.$i18n.t('validation.attributes.image'),
                    data: 'image',
                    name: 'image',
                    orderable: false,
                    searchable: false,
                }, {
                    title: this.$i18n.t('validation.attributes.title'),
                    data: 'title',
                    name: 'translations.title',
                    defaultContent: this.$i18n.t('labels.no_value'),
                    width: 150,
                }, {
                    title: this.$i18n.t('validation.attributes.status'),
                    data: 'status',
                    name: 'status',
                    searchable: false,
                    className: 'text-center',
                    width: 75,
                }, {
                    title: this.$i18n.t('validation.attributes.pinned'),
                    data: 'pinned',
                    name: 'pinned',
                    searchable: false,
                    className: 'text-center',
                    width: 50,
                }, {
                    title: this.$i18n.t('validation.attributes.promoted'),
                    data: 'promoted',
                    name: 'promoted',
                    searchable: false,
                    className: 'text-center',
                    width: 100,
                }, {
                    title: this.$i18n.t('validation.attributes.summary'),
                    data: 'summary',
                    name: 'translations.summary',
                    defaultContent: this.$i18n.t('labels.no_value'),
                    orderable: false,
                }, {
                    title: this.$i18n.t('labels.author'),
                    data: 'owner.name',
                    name: 'owner.name',
                    orderable: false,
                    width: 100,
                    className: 'text-center'
                }, {
                    title: this.$i18n.t('labels.published_at'),
                    data: 'published_at',
                    name: 'published_at',
                    width: 75,
                    className: 'text-center'
                }, {
                    title: this.$i18n.t('labels.created_at'),
                    data: 'created_at',
                    name: 'created_at',
                    width: 75,
                    className: 'text-center'
                }, {
                    title: this.$i18n.t('labels.updated_at'),
                    data: 'updated_at',
                    name: 'updated_at',
                    width: 75,
                    className: 'text-center'
                }, {
                    title: this.$i18n.t('labels.actions'),
                    data: 'actions',
                    name: 'actions',
                    orderable: false,
                    width: 125,
                }],
                select: {style: 'os'},
                order: [[9, 'desc']],
                rowId: 'id'
            });
        }
    };
</script>
