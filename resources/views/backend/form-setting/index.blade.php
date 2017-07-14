@extends('backend.body')

@section('title', trans('labels.backend.form_settings.titles.index'))

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="pull-right mt-2">
                <a href="{{ route('admin.form_setting.create') }}" class="btn btn-success btn-sm"><i class="fa fa-plus"></i> @lang('buttons.form_settings.create')</a>
            </div>
            <h4 class="mt-1">@lang('labels.backend.form_settings.titles.index')</h4>
        </div>
        <div class="card-block">
            <table id="dataTableBuilder" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%"></table>
        </div>
    </div>
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
            buttons: [],
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
                defaultContent: '{{ trans('labels.no_value') }}',
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
                width: 75,
            }],
            order: [[0, 'asc']],
            rowId: 'id'
        });
    </script>
@endsection