@extends('backend.body')

@section('header_title', trans('labels.backend.form_settings.titles.main'))
@section('header_description', trans('labels.backend.form_settings.titles.index'))

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <div class="pull-right">
                        <a href="{{ route('admin.form_setting.create') }}" class="btn btn-success btn-sm">@lang('buttons.form_settings.create')</a>
                    </div>
                    <h3 class="box-title">@lang('labels.backend.form_settings.titles.index')</h3>
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
                url: '{{ route('admin.form_setting.search') }}',
                type: 'post'
            },
            columns: [{
                title: '{{ trans('validation.attributes.form_type') }}',
                data: 'name',
                name: 'name',
                width: 150,
            }, {
                title: '{{ trans('validation.attributes.recipients') }}',
                data: 'recipients',
                name: 'recipients',
                orderable: false,
            }, {
                title: '{{ trans('validation.attributes.message') }}',
                data: 'message',
                name: 'message',
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
            order: [[0, 'asc']],
            rowId: 'id'
        });
    </script>
@endsection