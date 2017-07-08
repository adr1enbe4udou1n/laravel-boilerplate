@extends('backend.body')

@section('title', trans('labels.backend.form_settings.titles.create'))

@section('content')
    <div class="row">
        <!-- left column -->
        <div class="col-md-6 col-md-offset-3">
            <!-- Horizontal Form -->
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">@lang('labels.backend.form_settings.titles.create')</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                {{ Form::open(['route' => 'admin.form_setting.store', 'class' => 'form-horizontal', 'form_setting' => 'form', 'method' => 'POST']) }}
                    @include('backend.form-setting.form')

                    <!-- /.box-body -->
                    <div class="box-footer">
                        <div class="pull-left">
                            <a href="{{ route('admin.form_setting.index') }}" class="btn btn-danger btn-sm">@lang('buttons.back')</a>
                        </div>
                        <div class="pull-right">
                            {{ Form::submit(trans('buttons.create'), ['class' => 'btn btn-success btn-sm']) }}
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
