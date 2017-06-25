@extends('backend.body')

@section('header_title', trans('labels.backend.posts.titles.main'))
@section('header_description', trans('labels.backend.posts.titles.index'))

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <div class="pull-right">
                        <a href="{{ route('admin.post.create') }}" class="btn btn-success btn-sm">@lang('buttons.posts.create')</a>
                    </div>
                    <h3 class="box-title">@lang('labels.backend.posts.titles.index')</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table class="table table-bordered table-hover" id="dataTableBuilder" width="100%"></table>
                    {!! form_batch_action('admin.post.batch-action', 'dataTableBuilder', [
                        'destroy' => trans('labels.backend.posts.actions.destroy'),
                        'publish' => trans('labels.backend.posts.actions.publish'),
                        'pin' => trans('labels.backend.posts.actions.pin'),
                        'promote' => trans('labels.backend.posts.actions.promote'),
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
                url: '{{ route('admin.post.search') }}',
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
                title: '{{ trans('validation.attributes.image') }}',
                data: 'image',
                name: 'image',
                orderable: false,
                searchable: false,
            }, {
                title: '{{ trans('validation.attributes.title') }}',
                data: 'title',
                name: 'translations.title',
                defaultContent: '{{ trans('labels.no_value') }}',
                width: 150,
            }, {
                title: '{{ trans('validation.attributes.status') }}',
                data: 'status',
                name: 'status',
                searchable: false,
                className: 'text-center',
                width: 75,
            }, {
                title: '{{ trans('validation.attributes.pinned') }}',
                data: 'pinned',
                name: 'pinned',
                searchable: false,
                className: 'text-center',
                width: 50,
            }, {
                title: '{{ trans('validation.attributes.promoted') }}',
                data: 'promoted',
                name: 'promoted',
                searchable: false,
                className: 'text-center',
                width: 100,
            }, {
                title: '{{ trans('validation.attributes.summary') }}',
                data: 'summary',
                name: 'translations.summary',
                defaultContent: '{{ trans('labels.no_value') }}',
                orderable: false,
            }, {
                title: '{{ trans('labels.author') }}',
                data: 'owner.name',
                name: 'owner.name',
                orderable: false,
                width: 100,
                className: 'text-center'
            }, {
                title: '{{ trans('labels.published_at') }}',
                data: 'published_at',
                name: 'published_at',
                defaultContent: '{{ trans('labels.no_value') }}',
                width: 75,
                className: 'text-center'
            }, {
                title: '{{ trans('labels.created_at') }}',
                data: 'created_at',
                name: 'created_at',
                width: 75,
                className: 'text-center'
            }, {
                title: '{{ trans('labels.updated_at') }}',
                data: 'updated_at',
                name: 'updated_at',
                width: 75,
                className: 'text-center'
            }, {
                title: '{{ trans('labels.actions') }}',
                data: 'actions',
                name: 'actions',
                orderable: false,
                width: 50,
            }],
            select: {style: 'os'},
            order: [[9, 'desc']],
            rowId: 'id'
        });
    </script>
@endsection