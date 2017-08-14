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

                            @component('components.fieldset', [
                                'name' => 'name',
                                'title' => trans('validation.attributes.name'),
                                'horizontal' => true,
                                'label_cols' => 3
                            ])
                                @component('components.input-group', [
                                    'left' => '<i class="icon-user"></i>'
                                ])
                                    {{ Form::text('name', null, [
                                        'placeholder' => trans('validation.attributes.name'),
                                        'class' => 'form-control',
                                        'v-validate' => "'required'",
                                    ]) }}
                                @endcomponent
                            @endcomponent

                            @component('components.fieldset', [
                                'name' => 'email',
                                'title' => trans('validation.attributes.email'),
                                'horizontal' => true,
                                'label_cols' => 3
                            ])
                                @component('components.input-group', [
                                    'left' => '<i class="icon-envelope"></i>'
                                ])
                                    {{ Form::text('email', null, [
                                        'placeholder' => trans('validation.attributes.email'),
                                        'class' => 'form-control',
                                        'v-validate' => "'required|email'",
                                    ]) }}
                                @endcomponent
                            @endcomponent

                            @component('components.fieldset', [
                                'name' => 'password',
                                'title' => trans('validation.attributes.password'),
                                'horizontal' => true,
                                'label_cols' => 3
                            ])
                                {{ Form::password('password', [
                                    'placeholder' => trans('validation.attributes.password'),
                                    'class' => 'form-control',
                                    'v-validate' => "'required'",
                                    'data-toggle' => 'password-strength-meter'
                                ]) }}
                            @endcomponent

                            @component('components.fieldset', [
                                'name' => 'password_confirmation',
                                'title' => trans('validation.attributes.password_confirmation'),
                                'horizontal' => true,
                                'label_cols' => 3
                            ])
                                {{ Form::password('password_confirmation', [
                                    'placeholder' => trans('validation.attributes.password_confirmation'),
                                    'class' => 'form-control',
                                    'v-validate' => "'required'"
                                ]) }}
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