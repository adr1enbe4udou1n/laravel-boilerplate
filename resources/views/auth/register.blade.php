@extends('layouts.frontend')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2 mt-4">
                <div class="card">
                    <div class="card-header">@lang('labels.user.register')</div>
                    <div class="card-block">
                        <form method="POST" action="{{ route('register') }}">
                            {{ csrf_field() }}

                            {{ Form::bsInput('name', [
                                'required' => true,
                                'title' => trans('validation.attributes.name'),
                                'label_col_class' => 'col-md-4',
                                'field_wrapper_class' => 'col-md-6',
                            ]) }}

                            {{ Form::bsInput('email', [
                                'required' => true,
                                'type' => 'email',
                                'title' => trans('validation.attributes.email'),
                                'label_col_class' => 'col-md-4',
                                'field_wrapper_class' => 'col-md-6',
                            ]) }}

                            {{ Form::bsInput('password', [
                                'required' => true,
                                'title' => trans('validation.attributes.password'),
                                'type' => 'password',
                                'strength_meter' => true,
                                'label_col_class' => 'col-md-4',
                                'field_wrapper_class' => 'col-md-6',
                            ]) }}

                            {{ Form::bsInput('password_confirmation', [
                                'required' => true,
                                'title' => trans('validation.attributes.password_confirmation'),
                                'type' => 'password',
                                'label_col_class' => 'col-md-4',
                                'field_wrapper_class' => 'col-md-6',
                            ]) }}

                            <div class="form-group row">
                                <div class="col-md-6 offset-md-4">
                                    {!! Captcha::display() !!}
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
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