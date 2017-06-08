@extends('backend.body')

@section('header_title', trans('labels.backend.form_submissions.titles.main'))
@section('header_description', trans('labels.backend.form_submissions.titles.index'))

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">@lang('labels.backend.form_submissions.titles.index')</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    {!! $html->table() !!}
                    {!! form_batch_action('admin.form_submission.batch-action', 'dataTableBuilder', [
                        'delete' => trans('labels.backend.form_submissions.actions.destroy'),
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