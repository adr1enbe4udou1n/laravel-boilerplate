@extends('layouts.frontend')

@section('body_class', 'login-page')

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">@lang('labels.user.login')</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}

                        {!! form_row('email', [
                            'name' => 'email',
                            'required' => true,
                            'title' => trans('validation.attributes.email'),
                            'label_class' => 'col-md-4',
                            'field_wrapper_class' => 'col-md-6',
                        ]) !!}

                        {!! form_row('password', [
                            'name' => 'password',
                            'required' => true,
                            'title' => trans('validation.attributes.password'),
                            'label_class' => 'col-md-4',
                            'field_wrapper_class' => 'col-md-6',
                        ]) !!}

                        @if($is_locked)
                        <div class="form-group">
                            <div class="col-md-2 col-sm-12 col-md-offset-4">
                                {!! Captcha::display() !!}
                            </div>
                        </div>
                        @endif

                        {!! form_row('checkbox', [
                            'name' => 'remember',
                            'label' => trans('labels.user.remember'),
                            'field_wrapper_class' => 'col-md-6 col-md-offset-4',
                        ]) !!}

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    @lang('labels.user.login')
                                </button>

                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    @lang('labels.user.password_forgot')
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    {!! Captcha::script() !!}
@endsection