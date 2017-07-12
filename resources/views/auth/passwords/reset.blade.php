@extends('layouts.frontend')

@section('body_class', 'login-page')

@section('content')
    <div class="row">
        <div class="col-md-8 offset-md-2 mt-4">
            <div class="card">
                <div class="card-header">@lang('labels.user.password_reset')</div>

                <div class="card-block">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form role="form" method="POST" action="{{ route('password.request') }}">
                        {{ csrf_field() }}

                        <input type="hidden" name="token" value="{{ $token }}">

                        {{ Form::bsText('email', [
                            'required' => true,
                            'type' => 'email',
                            'title' => trans('validation.attributes.email'),
                            'label_col_class' => 'col-md-4',
                            'field_wrapper_class' => 'col-md-6',
                        ]) }}

                        {{ Form::bsPassword('password', [
                            'required' => true,
                            'title' => trans('validation.attributes.password'),
                            'strength_meter' => true,
                            'label_col_class' => 'col-md-4',
                            'field_wrapper_class' => 'col-md-6',
                        ]) }}

                        {{ Form::bsPassword('password_confirmation', [
                            'required' => true,
                            'title' => trans('validation.attributes.password_confirmation'),
                            'label_col_class' => 'col-md-4',
                            'field_wrapper_class' => 'col-md-6',
                        ]) }}

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
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
