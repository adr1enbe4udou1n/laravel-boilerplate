@extends('layouts.frontend')

@section('body_class', 'login-page')

<!-- Main Content -->
@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">@lang('labels.user.send_password_link')</div>
                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form class="form-horizontal" role="form" method="POST" action="{{ route('password.email') }}">
                        {{ csrf_field() }}

                        {!! form_row('email', [
                            'name' => 'email',
                            'required' => true,
                            'title' => trans('validation.attributes.email'),
                            'label_class' => 'col-md-4',
                            'field_wrapper_class' => 'col-md-6',
                        ]) !!}

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
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
