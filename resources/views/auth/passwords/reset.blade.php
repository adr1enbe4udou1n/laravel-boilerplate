@extends('layouts.frontend')

@section('body_class', 'login-page')

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">@lang('labels.user.password_reset')</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form class="form-horizontal" role="form" method="POST" action="{{ route('password.request') }}">
                        {{ csrf_field() }}

                        <input type="hidden" name="token" value="{{ $token }}">

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

                        {!! form_row('password', [
                            'name' => 'password_confirmation',
                            'required' => true,
                            'title' => trans('validation.attributes.password_confirmation'),
                            'label_class' => 'col-md-4',
                            'field_wrapper_class' => 'col-md-6',
                        ]) !!}

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    @lang('labels.user.password_reset')
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
