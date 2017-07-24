@extends('layouts.frontend')

@section('body_class', 'login-page')

<!-- Main Content -->
@section('content')
    <div class="row">
        <div class="col-md-12 col-lg-6 offset-lg-3 mt-4">
            <div class="card">
                <div class="card-header">@lang('labels.user.send_password_link')</div>
                <div class="card-block">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        {{ csrf_field() }}

                        @component('components.fieldset', [
                            'name' => 'email',
                            'title' => trans('validation.attributes.email'),
                            'horizontal' => true,
                            'label_cols' => 4
                        ])
                            @component('components.input-group', [
                                'left' => '<i class="icon-user"></i>'
                            ])
                                {{ Form::bsInput('email', [
                                    'type' => 'email',
                                    'required' => true,
                                    'placeholder' => trans('validation.attributes.email'),
                                ]) }}
                            @endcomponent
                        @endcomponent

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <button  class="btn btn-primary">
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
