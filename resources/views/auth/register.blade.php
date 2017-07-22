@extends('layouts.frontend')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-lg-6 offset-lg-3 mt-4">
                <div class="card">
                    <div class="card-header">@lang('labels.user.register')</div>
                    <div class="card-block">
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
                                    {{ Form::bsInput('name', [
                                        'required' => true,
                                        'placeholder' => trans('validation.attributes.name'),
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
                                    {{ Form::bsInput('email', [
                                        'type' => 'email',
                                        'required' => true,
                                        'placeholder' => trans('validation.attributes.email'),
                                    ]) }}
                                @endcomponent
                            @endcomponent

                            @component('components.fieldset', [
                                'name' => 'password',
                                'title' => trans('validation.attributes.password'),
                                'horizontal' => true,
                                'label_cols' => 3
                            ])
                                {{ Form::bsInput('password', [
                                    'type' => 'password',
                                    'required' => true,
                                    'placeholder' => trans('validation.attributes.password'),
                                    'strength_meter' => true,
                                ]) }}
                            @endcomponent

                            @component('components.fieldset', [
                                'name' => 'password_confirmation',
                                'title' => trans('validation.attributes.password_confirmation'),
                                'horizontal' => true,
                                'label_cols' => 3
                            ])
                                {{ Form::bsInput('password_confirmation', [
                                    'type' => 'password',
                                    'required' => true,
                                    'placeholder' => trans('validation.attributes.password_confirmation'),
                                ]) }}
                            @endcomponent

                            <div class="form-group row">
                                <div class="col-md-9 offset-md-3">
                                    {!! Captcha::display() !!}
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-9 offset-md-3">
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