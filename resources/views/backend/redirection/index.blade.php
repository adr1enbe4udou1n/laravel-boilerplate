@extends('backend.body')

@section('header_title', trans('labels.backend.redirections.titles.main'))
@section('header_description', trans('labels.backend.redirections.titles.index'))

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <div class="pull-right">
                        <a href="{{ route('admin.redirection.create') }}" class="btn btn-success btn-sm">@lang('buttons.redirections.create')</a>
                    </div>
                    <h3 class="box-title">@lang('labels.backend.redirections.titles.index')</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table class="table table-bordered table-hover" id="dataTableBuilder" width="100%"></table>
                    {!! form_batch_action('admin.redirection.batch-action', 'dataTableBuilder', [
                        'delete' => trans('labels.backend.redirections.actions.destroy'),
                        'enable' => trans('labels.backend.redirections.actions.enable'),
                        'disable' => trans('labels.backend.redirections.actions.disable')
                    ]) !!}
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
@endsection

@section('scripts')
    <script>
        $('#dataTableBuilder').DataTable({
            serverSide: true,
            processing: true,
            ajax: {
                url: '{{ route('admin.redirection.search') }}',
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
                title: '{{ trans('validation.attributes.source_path') }}',
                data: 'source',
                name: 'source',
            }, {
                title: '{{ trans('validation.attributes.active') }}',
                data: 'active',
                name: 'active',
                orderable: false,
                width: 50,
                className: 'text-center'
            }, {
                title: '{{ trans('validation.attributes.target_path') }}',
                data: 'target',
                name: 'target',
            }, {
                title: '{{ trans('validation.attributes.redirect_type') }}',
                data: 'type',
                name: 'type',
                width: 150,
            }, {
                title: '{{ trans('labels.created_at') }}',
                data: 'created_at',
                name: 'created_at',
                width: 100,
                className: 'text-center'
            }, {
                title: '{{ trans('labels.updated_at') }}',
                data: 'updated_at',
                name: 'updated_at',
                width: 100,
                className: 'text-center'
            }, {
                title: '{{ trans('labels.actions') }}',
                data: 'actions',
                name: 'actions',
                orderable: false,
                width: 50,
            }],
            select: {style: 'os'},
            order: [[1, 'asc']],
            rowId: 'id'
        });
    </script>
@endsection