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

                            @component('components.form-group', [
                                'name' => 'name',
                                'title' => trans('validation.attributes.name'),
                                'horizontal' => true,
                                'label_cols' => 3
                            ])
                                <input name="name" placeholder="@lang('validation.attributes.name')"
                                       class="form-control {{ is_invalid('name') }}" required value="{{ old('name') }}">
                            @endcomponent

                            @component('components.form-group', [
                                'name' => 'email',
                                'title' => trans('validation.attributes.email'),
                                'horizontal' => true,
                                'label_cols' => 3
                            ])
                                <input type="email" name="email" placeholder="@lang('validation.attributes.email')"
                                       class="form-control {{ is_invalid('email') }}" required value="{{ old('email') }}">
                            @endcomponent

                            @component('components.form-group', [
                                'name' => 'password',
                                'title' => trans('validation.attributes.password'),
                                'horizontal' => true,
                                'label_cols' => 3
                            ])
                                <input type="password" name="password" placeholder="@lang('validation.attributes.password')"
                                       class="form-control {{ is_invalid('password') }}" required data-toggle="password-strength-meter">
                            @endcomponent

                            @component('components.form-group', [
                                'name' => 'password_confirmation',
                                'title' => trans('validation.attributes.password_confirmation'),
                                'horizontal' => true,
                                'label_cols' => 3
                            ])
                                <input type="password" name="password_confirmation"
                                       placeholder="@lang('validation.attributes.password_confirmation')"
                                       class="form-control {{ is_invalid('password_confirmation') }}" required>
                            @endcomponent

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

@section('scripts')
    {!! Captcha::script() !!}
@endsection
