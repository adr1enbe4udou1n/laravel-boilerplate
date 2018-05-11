@extends('layouts.backend')

@section('body')
    <div class="page">
        <div class="page-single">
            <div class="container">
                <div class="row">
                    <div class="col col-login mx-auto">
                        <form class="card" action="{{ route('login') }}" method="post">
                            @csrf

                            <div class="card-body p-6">
                                <div class="card-title">@lang('labels.user.login')</div>
                                <div class="form-group">
                                    <label class="form-label" for="email">@lang('validation.attributes.email')</label>
                                    {{ Form::bsEmail('email', null, ['required', 'placeholder' => __('validation.attributes.email')]) }}
                                </div>

                                <div class="form-group">
                                    <label class="form-label" for="password">
                                        @lang('validation.attributes.password')
                                        <a href="{{ route('admin.password.request') }}" class="float-right small">
                                            @lang('labels.user.password_forgot')
                                        </a>
                                    </label>
                                    {{ Form::bsPassword('password', ['required', 'placeholder' => __('validation.attributes.password')]) }}
                                </div>

                                @if($isLocked)
                                    <div class="form-group">
                                        {!! Form::captcha() !!}
                                    </div>
                                @endif
                                <div class="form-group">
                                    {{ Form::bsCheckbox('remember', __('labels.user.remember')) }}
                                </div>

                                <div class="form-footer">
                                    <button type="submit" class="btn btn-primary btn-block"><i class="fe fe-log-in"></i>&nbsp;@lang('labels.user.login')</button>
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
