@extends('layouts.backend')

<!-- Main Content -->
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
                                <div class="form-footer">
                                    <button type="submit" class="btn btn-primary btn-block">@lang('labels.user.send_password_link')</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
