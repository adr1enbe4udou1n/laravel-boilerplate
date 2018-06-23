@extends('layouts.backend')

@section('body')
    <div class="app flex-row align-items-center">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-4">
                    <div class="card p-4">
                        <div class="card-body">
                            <form action="{{ route('login') }}" method="post">
                                @csrf
                                <h1>@lang('labels.user.login')</h1>

                                <div class="form-group">
                                    <label for="email">@lang('validation.attributes.email')</label>
                                    {{ Form::bsEmail('email', null, ['required', 'placeholder' => __('validation.attributes.email')]) }}
                                </div>

                                <div class="form-group">
                                    <label for="password">
                                        @lang('validation.attributes.password')
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

                                <div class="d-flex align-items-center">
                                    <button type="submit" class="btn btn-primary"><i class="fe fe-log-in"></i>&nbsp;@lang('labels.user.login')</button>

                                    <a href="{{ route('admin.password.request') }}" class="ml-auto small">
                                        @lang('labels.user.password_forgot')
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    {!! Captcha::script() !!}
@endpush
