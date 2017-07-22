@extends('layouts.backend')

@section('body_class', 'flex-row align-items-center')

<!-- Main Content -->
@section('body')
    <div id="app" class="container">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card-group mb-0">
                    <div class="card p-4">
                        <div class="card-block">
                            <h1 class="mb-4">@lang('labels.user.login')</h1>

                            <form action="{{ route('login') }}" method="post">
                                {{ csrf_field() }}

                                <b-form-fieldset
                                        @if($errors->has('email'))
                                        state="danger"
                                        feedback="{{ $errors->first('email') }}"
                                        @endif
                                >
                                    <b-input-group :left="iconEnvelope">
                                        <b-form-input
                                                name="email"
                                                type="email"
                                                :required="true"
                                                placeholder="@lang('validation.attributes.email')"
                                                value="{{ old('email') }}"
                                        ></b-form-input>
                                    </b-input-group>
                                </b-form-fieldset>

                                <div class="form-group">
                                    <button class="btn btn-primary btn-block btn-flat">@lang('labels.user.send_password_link')</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
