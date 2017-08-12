@extends('layouts.backend')

@section('body_class', 'flex-row align-items-center')

<!-- Main Content -->
@section('body')
    <div class="container">
        <div class="row">
            <div class="col-md-5 mx-auto">
                <div class="card p-4">
                    <div class="card-body">
                        <h1 class="mb-4">@lang('labels.user.login')</h1>

                        <form action="{{ route('login') }}" method="post">
                            {{ csrf_field() }}

                            @component('components.fieldset', [
                                'name' => 'email',
                            ])
                                @component('components.input-group', [
                                    'left' => '<i class="icon-user"></i>'
                                ])
                                    {{ Form::email('email', null, [
                                        'placeholder' => trans('validation.attributes.email'),
                                        'class' => 'form-control',
                                        'v-validate' => "'required|email'",
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
@endsection
