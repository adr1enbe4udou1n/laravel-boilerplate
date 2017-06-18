@extends('backend.body')

@section('header_title', trans('labels.backend.roles.titles.main'))
@section('header_description', trans('labels.backend.roles.titles.create'))

@section('content')
    <div class="row">
        <!-- left column -->
        <div class="col-md-4 col-md-offset-4">
            <!-- Horizontal Form -->
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">@lang('labels.backend.roles.titles.create')</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                {{ Form::open(['route' => 'admin.role.store', 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'POST']) }}
                    @include('backend.role.form')

                    <!-- /.box-body -->
                    <div class="box-footer">
                        <div class="pull-left">
                            <a href="{{ route('admin.role.index') }}" class="btn btn-danger btn-sm">@lang('buttons.back')</a>
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
