@extends('layouts.frontend')

@section('body_class', 'login-page')

@section('content')
    <div class="row">
        <div class="col-md-12 col-lg-6 mx-auto">
            <div class="card">
                <div class="card-header">@lang('labels.user.login')</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label">@lang('validation.attributes.email')</label>

                            <div class="col-md-8">
                                {{ Form::bsEmail('email', null, ['required', 'placeholder' => __('validation.attributes.email')]) }}
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label">@lang('validation.attributes.password')</label>

                            <div class="col-md-8">
                                {{ Form::bsPassword('password', ['required', 'placeholder' => __('validation.attributes.password')]) }}
                            </div>
                        </div>

                        @if($isLocked)
                        <div class="form-group row">
                            <div class="col-md-8 ml-auto">
                                {!! Form::captcha() !!}
                            </div>
                        </div>
                        @endif

                        <div class="form-group row">
                            <div class="col-md-8 ml-auto">
                                {{ Form::bsCheckbox('remember', __('labels.user.remember')) }}
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

@push('scripts')
    {!! Captcha::script() !!}
@endpush
