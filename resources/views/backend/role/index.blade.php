@extends('backend.body')

@section('header_title', trans('labels.backend.roles.titles.main'))
@section('header_description', trans('labels.backend.roles.titles.index'))

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <div class="pull-right">
                        <a href="{{ route('admin.role.create') }}" class="btn btn-success btn-sm">@lang('buttons.roles.create')</a>
                    </div>
                    <h3 class="box-title">@lang('labels.backend.roles.titles.index')</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table class="table table-bordered table-hover" id="dataTableBuilder" width="100%"></table>
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
            lengthChange: false,
            searching: false,
            paging: false,
            info: false,
            ajax: {
                url: '{{ route('admin.role.search') }}',
                type: 'post'
            },
            columns: [{
                title: '{{ trans('validation.attributes.name') }}',
                data: 'name',
                name: 'name',
                width: 150,
            }, {
                title: '{{ trans('validation.attributes.display_name') }}',
                data: 'display_name',
                name: 'display_name',
                width: 150,
            }, {
                title: '{{ trans('validation.attributes.description') }}',
                data: 'description',
                name: 'description',
                orderable: false,
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
            order: [[0, 'asc']]
        });
    </script>
@endsection