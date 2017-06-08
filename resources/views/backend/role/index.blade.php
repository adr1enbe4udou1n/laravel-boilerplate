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
                    {!! $html->table() !!}
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