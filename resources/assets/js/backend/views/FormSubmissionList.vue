<template>
    <div class="animated fadeIn">
        <div class="card">
            <div class="card-header">
                <h4>{{ $t('labels.backend.form_submissions.titles.index') }}</h4>
            </div>
            <div class="card-block">
                <table id="dataTableBuilder" class="table table-striped table-bordered table-hover" cellspacing="0"
                       width="100%"></table>
                <batch-action :options="options" :url="`${this.$root.adminPath}/form-submission/batch-action`" datatable="dataTableBuilder"></batch-action>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'form_submission_list',
        data() {
            return {
                options: {
                    destroy: this.$i18n.t('labels.backend.form_submissions.actions.destroy')
                }
            };
        },
        mounted() {
            $('#dataTableBuilder').DataTable({
                responsive: true,
                serverSide: true,
                processing: true,
                ajax: {
                    url: `${this.$root.adminPath}/form-submission/search`,
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
                    title: this.$i18n.t('validation.attributes.form_type'),
                    data: 'type',
                    name: 'type',
                    width: 150,
                    responsivePriority: 1,
                }, {
                    title: this.$i18n.t('validation.attributes.form_data'),
                    data: 'data',
                    name: 'data',
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
                    responsivePriority: 2,
                }],
                select: {style: 'os'},
                order: [[3, 'desc']],
                rowId: 'id'
            });
        }
    };
</script>
