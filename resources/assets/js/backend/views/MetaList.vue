<template>
    <div class="animated fadeIn">
        <div class="card">
            <div class="card-header">
                <div class="pull-right mt-2">
                    <router-link to="/meta/create" class="btn btn-success btn-sm"><i class="icon-plus"></i>
                        {{ $t('buttons.metas.create') }}
                    </router-link>
                </div>
                <h4 class="mt-1">{{ $t('labels.backend.metas.titles.index') }}</h4>
            </div>
            <div class="card-block">
                <table id="dataTableBuilder" class="table table-striped table-bordered table-hover" cellspacing="0"
                       width="100%"></table>
                <batch-action :options="options"></batch-action>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'meta_list',
        data() {
            return {
                options: {
                    destroy: this.$i18n.t('labels.backend.metas.actions.destroy'),
                }
            }
        },
        mounted() {
            $('#dataTableBuilder').DataTable({
                serverSide: true,
                processing: true,
                ajax: {
                    url: '/admin/meta/search',
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
                    title: this.$i18n.t('validation.attributes.route'),
                    data: 'route',
                    name: 'route',
                    defaultContent: this.$i18n.t('labels.no_value'),
                    width: 75,
                }, {
                    title: this.$i18n.t('validation.attributes.metable_type'),
                    data: 'metable_type',
                    name: 'metable_type',
                    defaultContent: this.$i18n.t('labels.no_value'),
                    width: 75,
                }, {
                    title: this.$i18n.t('validation.attributes.title'),
                    data: 'title',
                    name: 'translations.title',
                    defaultContent: this.$i18n.t('labels.no_value'),
                    width: 150,
                }, {
                    title: this.$i18n.t('validation.attributes.description'),
                    data: 'description',
                    name: 'translations.description',
                    defaultContent: this.$i18n.t('labels.no_value'),
                    orderable: false,
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
                }],
                select: {style: 'os'},
                order: [[5, 'desc']],
                rowId: 'id'
            });
        }
    }
</script>
