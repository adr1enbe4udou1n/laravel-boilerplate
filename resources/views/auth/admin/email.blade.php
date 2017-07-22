@extends('layouts.backend')

@section('body_class', 'flex-row align-items-center')

<!-- Main Content -->
@section('body')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card-group mb-0">
                    <div class="card p-4">
                        <div class="card-block">
                            <h1 class="mb-4">@lang('labels.user.login')</h1>

                            <form action="{{ route('login') }}" method="post">
                                {{ csrf_field() }}

                                @component('components.fieldset', [
                                    'name' => 'email',
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

                                <div class="form-group">
                                    <button class="btn btn-primary btn-block btn-flat">@lang('labels.user.send_password_link')</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
