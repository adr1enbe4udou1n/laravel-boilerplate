@extends('layouts.frontend')

@section('body_class', 'login-page')

@section('content')
    <div class="row">
        <div class="col-md-12 col-lg-6 mx-auto">
            <div class="card">
                <div class="card-header">@lang('labels.user.password_reset')</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.request') }}">
                        @csrf

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label">@lang('validation.attributes.email')</label>

                            <div class="col-md-8">
                                {{ Form::bsEmail('email', null, ['required', 'placeholder' => __('validation.attributes.email')]) }}
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label">@lang('validation.attributes.password')</label>

                            <div class="col-md-8">
                                {{ Form::bsPassword('password', ['required', 'placeholder' => __('validation.attributes.password'), 'data-toggle' => 'password-strength-meter']) }}
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password_confirmation" class="col-md-4 col-form-label">@lang('validation.attributes.password_confirmation')</label>

                            <div class="col-md-8">
                                {{ Form::bsPassword('password_confirmation', ['required', 'placeholder' => __('validation.attributes.password_confirmation')]) }}
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-8 ml-auto">
                                <button class="btn btn-primary">
                                    @lang('labels.user.password_reset')
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
