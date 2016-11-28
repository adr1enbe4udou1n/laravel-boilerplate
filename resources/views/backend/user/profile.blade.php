@extends('backend.body')

@section('header_title', trans('labels.backend.users.titles.main'))
@section('header_description', trans('labels.backend.users.titles.edit'))

@section('content')
    <div class="row">
        <!-- left column -->
        <div class="col-md-6 col-md-offset-3">
            <!-- Horizontal Form -->
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">@lang('labels.backend.users.titles.edit')</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                {{ Form::model($user, ['route' => ['admin.profile.update'], 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'PATCH']) }}
                <div class="box-body">
                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        {{ Form::label('email', trans('validation.attributes.email'), ['class' => 'col-lg-2 control-label']) }}

                        <div class="col-sm-10">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                {{ Form::text('email', null, ['class' => 'form-control', 'placeholder' => trans('validation.attributes.email')]) }}
                            </div>
                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                        {{ Form::label('name', trans('validation.attributes.name'), ['class' => 'col-lg-2 control-label']) }}

                        <div class="col-sm-10">
                            {{ Form::text('name', null, ['class' => 'form-control', 'placeholder' => trans('validation.attributes.name')]) }}
                            @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                        {{ Form::label('password', trans('validation.attributes.password'), ['class' => 'col-lg-2 control-label']) }}

                        <div class="col-sm-10">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                {{ Form::password('password', ['class' => 'form-control', 'placeholder' => trans('validation.attributes.password')]) }}
                            </div>
                            @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                        {{ Form::label('password_confirmation', trans('validation.attributes.password_confirmation'), ['class' => 'col-lg-2 control-label']) }}

                        <div class="col-lg-10">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                {{ Form::password('password_confirmation', ['class' => 'form-control', 'placeholder' => trans('validation.attributes.password_confirmation')]) }}
                            </div>
                            @if ($errors->has('password_confirmation'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password_confirmation') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- /.box-body -->
                <div class="box-footer">
                    <div class="pull-left">
                        <a href="{{ route('admin.user.index') }}"
                           class="btn btn-danger btn-xs">@lang('buttons.back')</a>
                    </div>
                    <div class="pull-right">
                        {{ Form::submit(trans('buttons.edit'), ['class' => 'btn btn-success btn-xs']) }}
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
