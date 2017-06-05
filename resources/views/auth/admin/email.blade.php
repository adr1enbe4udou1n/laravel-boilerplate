@extends('layouts.backend')

@section('body_class', 'login-page')

<!-- Main Content -->
@section('body')
    <div class="login-box">
        <div class="login-box-body">
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif

            <form action="{{ route('password.email') }}" method="post">
                {{ csrf_field() }}

                {!! form_row('email', [
                    'name' => 'email',
                    'required' => true,
                    'rules' => 'email',
                    'placeholder' => trans('validation.attributes.email'),
                    'feedback_class' => 'glyphicon glyphicon-envelope',
                ]) !!}

                <div class="row">
                    <!-- /.col -->
                    <div class="col-xs-12">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">@lang('labels.user.send_password_link')</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>
        </div>
        <!-- /.login-box-body -->
    </div>
    <!-- /.login-box -->
@endsection
