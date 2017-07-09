@extends('backend.body')

@section('title', trans('labels.backend.form_submissions.titles.index'))

@section('content')
    <div class="card">
        <div class="card-header">
            <h4>@lang('labels.backend.form_submissions.titles.index')</h4>
        </div>
        <div class="card-block">
            <table id="dataTableBuilder" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%"></table>
            {!! form_batch_action('admin.form_submission.batch-action', 'dataTableBuilder', [
                'destroy' => trans('labels.backend.form_submissions.actions.destroy'),
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
                url: '{{ route('admin.form_submission.search') }}',
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
                title: '{{ trans('validation.attributes.form_type') }}',
                data: 'type',
                name: 'type',
                width: 150,
            }, {
                title: '{{ trans('validation.attributes.form_data') }}',
                data: 'data',
                name: 'data',
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
            order: [[3, 'desc']],
            rowId: 'id'
        });
    </script>
@endsection