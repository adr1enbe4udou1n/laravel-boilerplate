@extends('layouts.frontend')

@section('body_class', 'login-page')

@section('content')
    <div class="row">
        <div class="col-md-8 offset-md-2 mt-4">
            <div class="card">
                <div class="card-header">@lang('labels.user.login')</div>
                <div class="card-block">
                    <form role="form" method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}

                        {{ Form::bsText('email', [
                            'required' => true,
                            'title' => trans('validation.attributes.email'),
                            'type' => 'email',
                            'label_col_class' => 'col-sm-4',
                            'field_wrapper_class' => 'col-sm-6',
                            'input_group_prefix' => '<i class="icon-user"></i>',
                        ]) }}

                        {{ Form::bsPassword('password', [
                            'required' => true,
                            'title' => trans('validation.attributes.password'),
                            'label_col_class' => 'col-sm-4',
                            'field_wrapper_class' => 'col-sm-6',
                            'input_group_prefix' => '<i class="icon-lock"></i>',
                        ]) }}

                        @if($is_locked)
                        <div class="form-group row">
                            <div class="col-md-2 col-sm-12 offset-md-4">
                                {!! Captcha::display() !!}
                            </div>
                        </div>
                        @endif

                        {{ Form::bsCheckbox('remember', [
                            'label' => trans('labels.user.remember'),
                            'field_wrapper_class' => 'col-md-6 offset-md-4',
                        ]) }}

                        <div class="form-group row">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    @lang('labels.user.login')
                                </button>

                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    @lang('labels.user.password_forgot')
                                </a>
                            </div>
                        </div>
                    </form>
                    <div class="row justify-content-center">
                        {!! $socialite_links !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    {!! Captcha::script() !!}
@endsection