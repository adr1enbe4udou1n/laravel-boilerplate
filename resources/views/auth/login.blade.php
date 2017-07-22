@extends('layouts.frontend')

@section('body_class', 'login-page')

@section('content')
    <div class="row">
        <div class="col-md-12 col-lg-6 offset-lg-3 mt-4">
            <div class="card">
                <div class="card-header">@lang('labels.user.login')</div>
                <div class="card-block">
                    <form method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}

                        <b-form-fieldset
                                @if($errors->has('email'))
                                state="danger"
                                feedback="{{ $errors->first('email') }}"
                                @endif
                                label-for="email"
                                label="@lang('validation.attributes.email')"
                                :horizontal="true"
                                :label-cols="4"
                        >
                            <b-input-group :left="iconEnvelope">
                                <b-form-input
                                        id="email"
                                        name="email"
                                        type="email"
                                        :required="true"
                                        placeholder="@lang('validation.attributes.email')"
                                        value="{{ old('email') }}"
                                ></b-form-input>
                            </b-input-group>
                        </b-form-fieldset>

                        <b-form-fieldset
                                @if($errors->has('password'))
                                state="danger"
                                feedback="{{ $errors->first('password') }}"
                                @endif
                                label-for="password"
                                label="@lang('validation.attributes.password')"
                                :horizontal="true"
                                :label-cols="4"
                        >
                            <b-input-group :left="iconLock">
                                <b-form-input
                                        id="password"
                                        name="password"
                                        type="password"
                                        :required="true"
                                        placeholder="@lang('validation.attributes.password')"
                                ></b-form-input>
                            </b-input-group>
                        </b-form-fieldset>

                        @if($is_locked)
                            <div class="form-group row">
                                <div class="col-md-2 col-sm-12 offset-md-4">
                                    {!! Captcha::display() !!}
                                </div>
                            </div>
                        @endif

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <b-form-checkbox name="remember">
                                    @lang('labels.user.remember')
                                </b-form-checkbox>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-8 offset-md-4">
                                <button class="btn btn-primary">
                                    @lang('labels.user.login')
                                </button>

                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    @lang('labels.user.password_forgot')
                                </a>
                            </div>
                        </div>
                    </form>
                    <div class="row justify-content-center">
                        {!! $socialite_links !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    {!! Captcha::script() !!}
@endsection