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
                        {{ csrf_field() }}

                        <input type="hidden" name="token" value="{{ $token }}">

                        {{ Form::bsEmail('email', __('validation.attributes.email'), null, ['required', 'placeholder' => __('validation.attributes.email')], 4) }}
                        {{ Form::bsPassword('password', __('validation.attributes.password'), ['required', 'placeholder' => __('validation.attributes.password'), 'data-toggle' => 'password-strength-meter'], 4) }}
                        {{ Form::bsPassword('password_confirmation', __('validation.attributes.password_confirmation'), ['required', 'placeholder' => __('validation.attributes.password_confirmation')], 4) }}

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
