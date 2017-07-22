@extends('layouts.frontend')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-lg-6 offset-lg-3 mt-4">
                <div class="card">
                    <div class="card-header">@lang('labels.user.register')</div>
                    <div class="card-block">
                        <form method="POST" action="{{ route('register') }}">
                            {{ csrf_field() }}

                            <b-form-fieldset
                                    @if($errors->has('name'))
                                    state="danger"
                                    feedback="{{ $errors->first('name') }}"
                                    @endif
                                    label-for="name"
                                    label="@lang('validation.attributes.name')"
                                    :horizontal="true"
                                    :label-cols="3"
                            >
                                <b-input-group :left="iconUser">
                                    <b-form-input
                                            id="name"
                                            name="name"
                                            :required="true"
                                            placeholder="@lang('validation.attributes.name')"
                                    ></b-form-input>
                                </b-input-group>
                            </b-form-fieldset>

                            <b-form-fieldset
                                    @if($errors->has('email'))
                                    state="danger"
                                    feedback="{{ $errors->first('email') }}"
                                    @endif
                                    label-for="email"
                                    label="@lang('validation.attributes.email')"
                                    :horizontal="true"
                                    :label-cols="3"
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
                                    :label-cols="3"
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
                                    :label-cols="3"
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
                                <div class="col-md-9 offset-md-3">
                                    {!! Captcha::display() !!}
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-9 offset-md-3">
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

@section('scripts')
    {!! Captcha::script() !!}
@endsection