@extends('layouts.frontend')

@section('body_class', 'login-page')

@section('content')
    <div class="row">
        <div class="col-md-12 col-lg-6 offset-lg-3 mt-4">
            <div class="card">
                <div class="card-header">@lang('labels.user.password_reset')</div>

                <div class="card-block">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.request') }}">
                        {{ csrf_field() }}

                        <input type="hidden" name="token" value="{{ $token }}">

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
                            <b-form-input
                                    id="password"
                                    name="password"
                                    type="password"
                                    :required="true"
                                    placeholder="@lang('validation.attributes.password')"
                                    data-toggle="password-strength-meter"
                            ></b-form-input>
                        </b-form-fieldset>

                        <b-form-fieldset
                                @if($errors->has('password_confirmation'))
                                state="danger"
                                feedback="{{ $errors->first('password_confirmation') }}"
                                @endif
                                label-for="password_confirmation"
                                label="@lang('validation.attributes.password_confirmation')"
                                :horizontal="true"
                                :label-cols="4"
                        >
                            <b-form-input
                                    id="password_confirmation"
                                    name="password_confirmation"
                                    type="password"
                                    :required="true"
                                    placeholder="@lang('validation.attributes.password_confirmation')"
                            ></b-form-input>
                        </b-form-fieldset>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <button  class="btn btn-primary">
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
