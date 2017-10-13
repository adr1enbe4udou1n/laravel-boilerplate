@extends('layouts.frontend')

@section('body_class', 'login-page')

@section('content')
    <div class="row">
        <div class="col-md-12 col-lg-6 mx-auto">
            <div class="card">
                <div class="card-header">@lang('labels.user.login')</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}

                        @component('components.form-group', [
                            'name' => 'email',
                            'title' => trans('validation.attributes.email'),
                            'horizontal' => true,
                            'label_cols' => 4
                        ])
                            <input type="email" name="email" placeholder="@lang('validation.attributes.email')"
                                   class="form-control {{ is_invalid('email') }}" required value="{{ old('email') }}">
                        @endcomponent

                        @component('components.form-group', [
                            'name' => 'password',
                            'title' => trans('validation.attributes.password'),
                            'horizontal' => true,
                            'label_cols' => 4
                        ])
                            <input type="password" name="password" placeholder="@lang('validation.attributes.password')"
                                   class="form-control" required>
                        @endcomponent

                        @if($isLocked)
                        <div class="form-group row">
                            <div class="col-md-8 ml-auto">
                                {!! app('captcha')->display($attributes = [], $lang = app()->getLocale()); !!}
                            </div>
                        </div>
                        @endif

                        <div class="form-group row">
                            <div class="col-md-8 ml-auto">
                                <label class="custom-control custom-checkbox">
                                    <input type="checkbox" name="remember" class="custom-control-input">
                                    <span class="custom-control-indicator"></span>
                                    <span class="custom-control-description">@lang('labels.user.remember')</span>
                                </label>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-8 ml-auto">
                                <button  class="btn btn-primary">
                                    @lang('labels.user.login')
                                </button>

                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    @lang('labels.user.password_forgot')
                                </a>
                            </div>
                        </div>
                    </form>
                    <div class="row justify-content-center">
                        {!! $socialiteLinks !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
