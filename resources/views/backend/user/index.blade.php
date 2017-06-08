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
                    {!! $html->table() !!}
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
    {!! $html->scripts() !!}
@endsection