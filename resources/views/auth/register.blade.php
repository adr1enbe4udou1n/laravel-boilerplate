@extends('layouts.frontend')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-lg-8 mx-auto">
                <div class="card">
                    <div class="card-header">@lang('labels.user.register')</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="name" class="col-md-3 col-form-label">@lang('validation.attributes.name')</label>

                                <div class="col-md-9">
                                    {{ Form::bsText('name', null, ['required', 'placeholder' => __('validation.attributes.name')]) }}
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email" class="col-md-3 col-form-label">@lang('validation.attributes.email')</label>

                                <div class="col-md-9">
                                    {{ Form::bsEmail('email', null, ['required', 'placeholder' => __('validation.attributes.email')]) }}
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-3 col-form-label">@lang('validation.attributes.password')</label>

                                <div class="col-md-9">
                                    {{ Form::bsPassword('password', ['required', 'placeholder' => __('validation.attributes.password'), 'data-toggle' => 'password-strength-meter']) }}
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password_confirmation" class="col-md-3 col-form-label">@lang('validation.attributes.password_confirmation')</label>

                                <div class="col-md-9">
                                    {{ Form::bsPassword('password_confirmation', ['required', 'placeholder' => __('validation.attributes.password_confirmation')]) }}
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-9 ml-auto">
                                    {!! Form::captcha() !!}
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-9 ml-auto">
                                    <button  class="btn btn-primary">
                                        @lang('labels.user.register')
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    {!! Captcha::script() !!}
@endpush
