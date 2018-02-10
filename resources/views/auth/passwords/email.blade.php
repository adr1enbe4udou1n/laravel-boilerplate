@extends('layouts.frontend')

@section('body_class', 'login-page')

<!-- Main Content -->
@section('content')
    <div class="row">
        <div class="col-md-12 col-lg-5 mx-auto">
            <div class="card">
                <div class="card-header">@lang('labels.user.send_password_link')</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="form-group">
                            {{ Form::bsEmail('email', null, ['required', 'placeholder' => __('validation.attributes.email')]) }}
                        </div>

                        <div class="form-group">
                            <button  class="btn btn-primary">
                                @lang('labels.user.send_password_link')
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
