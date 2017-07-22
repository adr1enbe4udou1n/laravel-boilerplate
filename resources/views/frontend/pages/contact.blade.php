@extends('layouts.frontend')

@section('title', trans('labels.frontend.titles.contact'))

@section('body_class', 'page-contact')

@section('content')

    <div class="row">
        <div class="col-md-6">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d317718.69319292053!2d-0.3817765050863085!3d51.528307984912544!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47d8a00baf21de75%3A0x52963a5addd52a99!2sLondres%2C+Royaume-Uni!5e0!3m2!1sfr!2sfr!4v1496781964517"
                    height="550" frameborder="0" allowfullscreen></iframe>
        </div>
        <div class="col-md-6">
            <form action="{{ route('contact') }}" method="POST">
                {{ csrf_field() }}

                <b-form-fieldset
                        @if($errors->has('name'))
                        state="danger"
                        feedback="{{ $errors->first('name') }}"
                        @endif
                        label-for="name"
                        label="@lang('validation.attributes.name')"
                >
                    <b-form-input
                            id="name"
                            name="name"
                            :required="true"
                            placeholder="@lang('validation.attributes.name')"
                    ></b-form-input>
                </b-form-fieldset>
                
                <div class="row">
                    <div class="col-sm-6">
                        <b-form-fieldset
                                @if($errors->has('postal_code'))
                                state="danger"
                                feedback="{{ $errors->first('postal_code') }}"
                                @endif
                                label-for="postal_code"
                                label="@lang('validation.attributes.postal_code')"
                        >
                            <b-form-input
                                    id="postal_code"
                                    name="postal_code"
                                    placeholder="@lang('validation.attributes.postal_code')"
                            ></b-form-input>
                        </b-form-fieldset>
                    </div>
                    <div class="col-sm-6">
                        <b-form-fieldset
                                @if($errors->has('city'))
                                state="danger"
                                feedback="{{ $errors->first('city') }}"
                                @endif
                                label-for="city"
                                label="@lang('validation.attributes.city')"
                        >
                            <b-form-input
                                    id="city"
                                    name="city"
                                    placeholder="@lang('validation.attributes.city')"
                            ></b-form-input>
                        </b-form-fieldset>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <b-form-fieldset
                                @if($errors->has('email'))
                                state="danger"
                                feedback="{{ $errors->first('email') }}"
                                @endif
                                label-for="email"
                                label="@lang('validation.attributes.email')"
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
                    </div>
                    <div class="col-sm-6">
                        <b-form-fieldset
                                @if($errors->has('phone'))
                                state="danger"
                                feedback="{{ $errors->first('phone') }}"
                                @endif
                                label-for="phone"
                                label="@lang('validation.attributes.phone')"
                        >
                            <b-form-input
                                    id="phone"
                                    name="phone"
                                    type="tel"
                                    placeholder="@lang('validation.attributes.phone')"
                            ></b-form-input>
                        </b-form-fieldset>
                    </div>
                </div>

                <b-form-fieldset
                        @if($errors->has('message'))
                        state="danger"
                        feedback="{{ $errors->first('message') }}"
                        @endif
                        label-for="message"
                        label="@lang('validation.attributes.message')"
                >
                    <b-form-input
                            id="message"
                            name="message"
                            type="textarea"
                            :required="true"
                            placeholder="@lang('validation.attributes.message')"
                            :rows="5"
                    ></b-form-input>
                </b-form-fieldset>

                <div class="form-group">
                    {!! Captcha::display() !!}
                </div>

                <div class="form-group">
                    <input type="submit" class="btn btn-default" value="@lang('buttons.send')">
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    {!! Captcha::script() !!}
@endsection