@extends('layouts.backend')

@section('body_class', 'login-page')

@section('body')
    <div class="login-box">
        <div class="login-box-body">
            <form action="{{ url('/password/reset') }}" method="post">
                {{ csrf_field() }}

                <input type="hidden" name="token" value="{{ $token }}">

                <div class="form-group has-feedback{{ $errors->has('email') ? ' has-error' : '' }}">
                    <input type="email" class="form-control" placeholder="@lang('validation.attributes.email')" name="email" value="{{ old('email') }}">
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>

                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group has-feedback{{ $errors->has('password') ? ' has-error' : '' }}">
                    <input type="password" class="form-control" placeholder="@lang('validation.attributes.password')" name="password">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>

                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group has-feedback{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                    <input type="password" class="form-control" placeholder="@lang('validation.attributes.password_confirmation')" name="password_confirmation">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>

                    @if ($errors->has('password_confirmation'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">@lang('passwords.reset_password')</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>
        </div>
        <!-- /.login-box-body -->
    </div>
    <!-- /.login-box -->
@endsection
