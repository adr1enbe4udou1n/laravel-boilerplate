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

                                {{ Form::bsText('email', [
                                    'required' => true,
                                    'type' => 'email',
                                    'placeholder' => trans('validation.attributes.email'),
                                    'input_group_prefix' => '<i class="fa fa-envelope"></i>',
                                ]) }}

                                <div class="form-group">
                                    <button type="submit"
                                            class="btn btn-primary btn-block btn-flat">@lang('labels.user.send_password_link')</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
