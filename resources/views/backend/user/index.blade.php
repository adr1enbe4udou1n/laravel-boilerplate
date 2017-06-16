@extends('backend.body')

@section('header_title', trans('labels.backend.users.titles.main'))
@section('header_description', trans('labels.backend.users.titles.index'))

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <div class="pull-right">
                        <a href="{{ route('admin.user.create') }}" class="btn btn-success btn-sm">@lang('buttons.users.create')</a>
                    </div>
                    <h3 class="box-title">@lang('labels.backend.users.titles.index')</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table class="table table-bordered table-hover" id="dataTableBuilder" width="100%"></table>
                    {!! form_batch_action('admin.user.batch-action', 'dataTableBuilder', [
                        'destroy' => trans('labels.backend.users.actions.destroy'),
                        'enable' => trans('labels.backend.users.actions.enable'),
                        'disable' => trans('labels.backend.users.actions.disable')
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
                url: '{{ route('admin.user.search') }}',
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
                title: '{{ trans('validation.attributes.name') }}',
                data: 'name',
                name: 'name',
                width: 150,
            }, {
                title: '{{ trans('validation.attributes.email') }}',
                data: 'email',
                name: 'email',
                width: 150,
            }, {
                title: '{{ trans('validation.attributes.confirmed') }}',
                data: 'confirmed',
                name: 'confirmed',
                orderable: false,
                searchable: false,
                width: 50,
                className: 'text-center'
            }, {
                title: '{{ trans('validation.attributes.roles') }}',
                data: 'roles',
                name: 'roles',
                orderable: false,
                searchable: false,
            }, {
                title: '{{ trans('labels.last_access_at') }}',
                data: 'last_access_at',
                name: 'last_access_at',
                width: 100,
                className: 'text-center'
            }, {
                title: '{{ trans('validation.attributes.active') }}',
                data: 'active',
                name: 'active',
                orderable: false,
                searchable: false,
                width: 50,
                className: 'text-center'
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
                width: 75,
            }],
            select: {style: 'os'},
            order: [[7, 'desc']],
            rowId: 'id'
        });
    </script>
@endsection