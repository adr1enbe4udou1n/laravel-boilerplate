@extends('backend.body')

@section('title', trans('labels.backend.metas.titles.index'))

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="pull-right mt-2">
                <a href="{{ route('admin.meta.create') }}" class="btn btn-success btn-sm"><i class="icon-plus"></i> @lang('buttons.metas.create')</a>
            </div>
            <h4 class="mt-1">@lang('labels.backend.metas.titles.index')</h4>
        </div>
        <div class="card-block">
            <table id="dataTableBuilder" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%"></table>
            {!! form_batch_action('admin.meta.batch-action', 'dataTableBuilder', [
                'destroy' => trans('labels.backend.metas.actions.destroy'),
            ]) !!}
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $('#dataTableBuilder').DataTable({
            serverSide: true,
            processing: true,
            ajax: {
                url: '{{ route('admin.meta.search') }}',
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
                title: '{{ trans('validation.attributes.route') }}',
                data: 'route',
                name: 'route',
                defaultContent: '{{ trans('labels.no_value') }}',
                width: 75,
            }, {
                title: '{{ trans('validation.attributes.metable_type') }}',
                data: 'metable_type',
                name: 'metable_type',
                defaultContent: '{{ trans('labels.no_value') }}',
                width: 75,
            }, {
                title: '{{ trans('validation.attributes.title') }}',
                data: 'title',
                name: 'translations.title',
                defaultContent: '{{ trans('labels.no_value') }}',
                width: 150,
            }, {
                title: '{{ trans('validation.attributes.description') }}',
                data: 'description',
                name: 'translations.description',
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
            select: {style: 'os'},
            order: [[5, 'desc']],
            rowId: 'id'
        });
    </script>
@endsection