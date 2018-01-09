@extends('layouts.frontend')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-lg-8 mx-auto">
                <div class="card">
                    <div class="card-header">@lang('labels.user.register')</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('register') }}">
                            {{ csrf_field() }}

                            {{ Form::bsText('name', __('validation.attributes.name'), null, ['required', 'placeholder' => __('validation.attributes.name')], 3) }}
                            {{ Form::bsEmail('email', __('validation.attributes.email'), null, ['required', 'placeholder' => __('validation.attributes.email')], 3) }}
                            {{ Form::bsPassword('password', __('validation.attributes.password'), ['required', 'placeholder' => __('validation.attributes.password'), 'data-toggle' => 'password-strength-meter'], 3) }}
                            {{ Form::bsPassword('password_confirmation', __('validation.attributes.password_confirmation'), ['required', 'placeholder' => __('validation.attributes.password_confirmation')], 3) }}

                            <div class="form-group row">
                                <div class="col-md-9 ml-auto">
                                    {!! Captcha::display() !!}
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
