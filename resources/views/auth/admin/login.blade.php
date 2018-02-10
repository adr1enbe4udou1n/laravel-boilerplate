@extends('layouts.backend')

@section('body_class', 'flex-row align-items-center')

@section('body')
    <div class="container">
        <div class="row">
            <div class="col-md-4 mx-auto">
                <div class="card p-2">
                    <div class="card-body">
                        <h1 class="mb-4">@lang('labels.user.login')</h1>

                        <form action="{{ route('login') }}" method="post">
                            @csrf

                            <div class="form-group">
                                {{ Form::bsEmail('email', null, ['required', 'placeholder' => __('validation.attributes.email')]) }}
                            </div>

                            <div class="form-group">
                                {{ Form::bsPassword('password', ['required', 'placeholder' => __('validation.attributes.password')]) }}
                            </div>

                            @if($isLocked)
                                <div class="form-group">
                                    {!! Captcha::display() !!}
                                </div>
                            @endif
                            <div class="form-group">
                                <div class="checkbox">
                                    {{ Form::bsCheckbox('remember', __('labels.user.remember')) }}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-4">
                                    <button  class="btn btn-primary"><i class="icon-login"></i> @lang('labels.user.login')</button>
                                </div>
                                <div class="col-8 text-right">
                                    <a class="btn btn-link" href="{{ route('admin.password.request') }}">
                                        @lang('labels.user.password_forgot')
                                    </a>
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
