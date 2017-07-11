@extends('layouts.frontend')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2 mt-4">
                <div class="card">
                    <div class="card-header">@lang('labels.user.register')</div>
                    <div class="card-block">
                        <form role="form" method="POST" action="{{ route('register') }}">
                            {{ csrf_field() }}

                            {{ Form::bsText('name', [
                                'required' => true,
                                'title' => trans('validation.attributes.name'),
                                'label_col_class' => 'col-md-4',
                                'field_wrapper_class' => 'col-md-6',
                            ]) }}

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