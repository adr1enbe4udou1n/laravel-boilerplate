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
                        {{ csrf_field() }}

                        @component('components.form-group', [
                            'name' => 'email',
                            'title' => __('validation.attributes.email'),
                        ])
                            <input type="email" name="email" placeholder="@lang('validation.attributes.email')" class="form-control {{ is_invalid('email') }}" required value="{{ old('email') }}">
                        @endcomponent

                        <div class="form-group row">
                            <div class="col-md-6">
                                <button  class="btn btn-primary">
                                    @lang('labels.user.send_password_link')
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
