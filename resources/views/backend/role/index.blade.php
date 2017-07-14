@extends('backend.body')

@section('title', trans('labels.backend.roles.titles.index'))

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="pull-right mt-2">
                <a href="{{ route('admin.role.create') }}" class="btn btn-success btn-sm"><i class="fa fa-plus"></i> @lang('buttons.roles.create')</a>
            </div>
            <h4 class="mt-1">@lang('labels.backend.roles.titles.index')</h4>
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
                url: '{{ route('admin.role.search') }}',
                type: 'post'
            },
            columns: [{
                title: '{{ trans('validation.attributes.name') }}',
                data: 'name',
                name: 'name',
                orderable: false,
                width: 150,
            }, {
                title: '{{ trans('validation.attributes.order') }}',
                data: 'order',
                name: 'order',
                width: 120,
                className: 'text-right'
            }, {
                title: '{{ trans('validation.attributes.display_name') }}',
                data: 'display_name',
                name: 'display_name',
                defaultContent: '{{ trans('labels.no_value') }}',
                orderable: false,
                width: 150,
            }, {
                title: '{{ trans('validation.attributes.description') }}',
                data: 'description',
                name: 'description',
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
            order: [[1, 'asc']]
        });
    </script>
@endsection