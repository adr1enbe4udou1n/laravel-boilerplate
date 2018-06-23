@extends('layouts.backend')

<!-- Main Content -->
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
                                <button type="submit" class="btn btn-primary">@lang('labels.user.send_password_link')</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
