@extends('layouts.backend')

@section('body_class', 'login-page')

@section('body')
    <div class="login-box">
        <div class="login-box-body">
            <form action="{{ route('login') }}" method="post">
                {{ csrf_field() }}
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
                <div class="row">
                    <div class="col-xs-7">
                        <div class="checkbox icheck">
                            <label>
                                <input type="checkbox" name="remember"> @lang('labels.user.remember')
                            </label>
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-xs-5">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">@lang('labels.user.login')</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>

            <a href="{{ route('admin.password.request') }}">@lang('labels.user.password_forgot')</a>
        </div>
        <!-- /.login-box-body -->
    </div>
    <!-- /.login-box -->
@endsection
