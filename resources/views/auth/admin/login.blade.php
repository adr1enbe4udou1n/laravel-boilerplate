@extends('layouts.backend')

@section('body_class', 'login-page')

@section('body')
    <div class="login-box">
        <div class="login-box-body">
            <form action="{{ route('login') }}" method="post">
                {{ csrf_field() }}

                {{ Form::bsText('email', [
                    'required' => true,
                    'type' => 'email',
                    'placeholder' => trans('validation.attributes.email'),
                    'feedback_class' => 'glyphicon glyphicon-envelope',
                ]) }}

                {{ Form::bsPassword('password', [
                    'required' => true,
                    'placeholder' => trans('validation.attributes.password'),
                    'feedback_class' => 'glyphicon glyphicon-lock',
                ]) }}

                @if($is_locked)
                <div class="form-group">
                    {!! Captcha::display() !!}
                </div>
                @endif
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

@section('scripts')
    {!! Captcha::script() !!}
@endsection