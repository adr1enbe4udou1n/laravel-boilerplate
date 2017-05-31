@extends('backend.body')

@section('header_title', trans('labels.backend.metas.titles.main'))
@section('header_description', trans('labels.backend.metas.titles.create'))

@section('content')
    <div class="row">
        <!-- left column -->
        <div class="col-md-6 col-md-offset-3">
            <!-- Horizontal Form -->
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">@lang('labels.backend.metas.titles.create')</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                {{ Form::open(['route' => 'admin.meta.store', 'class' => 'form-horizontal', 'meta' => 'form', 'method' => 'POST']) }}
                    @include('backend.meta.form')

                    <!-- /.box-body -->
                    <div class="box-footer">
                        <div class="pull-left">
                            <a href="{{ route('admin.meta.index') }}" class="btn btn-danger btn-xs">@lang('buttons.back')</a>
                        </div>
                        <div class="pull-right">
                            {{ Form::submit(trans('buttons.create'), ['class' => 'btn btn-success btn-xs']) }}
                        </div>
                    </div>
                    <!-- /.box-footer -->
                {{ Form::close() }}
            </div>
            <!-- /.box -->
        </div>
        <!--/.col (right) -->
    </div>
@endsection
