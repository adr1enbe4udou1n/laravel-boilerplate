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
                            {{ csrf_field() }}

                            @component('components.fieldset', [
                                'name' => 'email',
                            ])
                                @component('components.input-group', [
                                    'left' => '<i class="icon-user"></i>'
                                ])
                                    <input type="email" name="email" placeholder="@lang('validation.attributes.email')"
                                           class="form-control" required value="{{ old('email') }}">
                                @endcomponent
                            @endcomponent

                            @component('components.fieldset', [
                                'name' => 'password',
                            ])
                                @component('components.input-group', [
                                    'left' => '<i class="icon-lock"></i>'
                                ])
                                    <input type="password" name="password" placeholder="@lang('validation.attributes.password')"
                                           class="form-control" required>
                                @endcomponent
                            @endcomponent

                            @if($isLocked)
                                <div class="form-group">
                                    {!! app('captcha')->display($attributes = [], $lang = app()->getLocale()); !!}
                                </div>
                            @endif
                            <div class="form-group">
                                <div class="checkbox">
                                    <label class="custom-control custom-checkbox">
                                        <input type="checkbox" name="remember" class="custom-control-input">
                                        <span class="custom-control-indicator"></span>
                                        <span class="custom-control-description">@lang('labels.user.remember')</span>
                                    </label>
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
