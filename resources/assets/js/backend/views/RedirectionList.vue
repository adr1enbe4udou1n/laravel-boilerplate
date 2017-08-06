<template>
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-sm-6">
                <div class="card">
                    <div class="card-header">
                        <h4>{{ $t('labels.backend.redirections.import.title') }}</h4>
                    </div>
                    <div class="card-block">
                        <form class="form-inline" @submit.prevent="onFileImport">
                            <b-input-file v-model="importFile"></b-input-file>
                            <input type="submit" class="btn btn-warning btn-md ml-1"
                                   :value="$t('buttons.redirections.import')">
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <div class="pull-right mt-2">
                    <router-link to="/redirection/create" class="btn btn-success btn-sm"><i class="icon-plus"></i>
                        {{ $t('buttons.redirections.create') }}
                    </router-link>
                </div>
                <h4 class="mt-1">{{ $t('labels.backend.redirections.titles.index') }}</h4>
            </div>
            <div class="card-block">
                <table id="dataTableBuilder" class="table table-striped table-bordered table-hover" cellspacing="0"
                       width="100%"></table>
                <batch-action :options="options" :url="`/${this.$root.adminPath}/redirection/batch-action`" datatable="dataTableBuilder"></batch-action>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'redirection_list',
        props: ['adminPath'],
        data() {
            return {
                importFile: null,
                options: {
                    destroy: this.$i18n.t('labels.backend.redirections.actions.destroy'),
                    enable: this.$i18n.t('labels.backend.redirections.actions.enable'),
                    disable: this.$i18n.t('labels.backend.redirections.actions.disable')
                }
            }
        },
        methods: {
            onFileImport() {
                let dataTable = $('#dataTableBuilder').DataTable();

                axios.post(`/${this.$root.adminPath}/redirection/import`, {
                    'import': this.importFile,
                }).then(function (response) {
                    dataTable.ajax.reload(null, false);
                    toastr[response.data.status](response.data.message);
                }).catch(function (error) {
                    toastr.error(error.response.data.error);
                });
            }
        },
        mounted() {
            $('#dataTableBuilder').DataTable({
                serverSide: true,
                processing: true,
                ajax: {
                    url: `/${this.$root.adminPath}/redirection/search`,
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
                    name: 'target',
                }, {
                    title: this.$i18n.t('validation.attributes.redirect_type'),
                    data: 'type',
                    name: 'type',
                    width: 150,
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
                order: [[1, 'asc']],
                rowId: 'id',
            });
        }
    }
</script>
