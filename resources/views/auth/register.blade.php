@extends('layouts.frontend')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">@lang('labels.user.register')</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('register') }}">
                        {{ csrf_field() }}

                        {!! form_row('text', [
                            'name' => 'name',
                            'title' => trans('validation.attributes.name'),
                            'label_class' => 'col-md-4',
                            'field_wrapper_class' => 'col-md-6',
                        ]) !!}

                        {!! form_row('email', [
                            'name' => 'email',
                            'title' => trans('validation.attributes.email'),
                            'label_class' => 'col-md-4',
                            'field_wrapper_class' => 'col-md-6',
                        ]) !!}

                        {!! form_row('password', [
                            'name' => 'password',
                            'title' => trans('validation.attributes.password'),
                            'label_class' => 'col-md-4',
                            'field_wrapper_class' => 'col-md-6',
                        ]) !!}

                        {!! form_row('password', [
                            'name' => 'password_confirmation',
                            'title' => trans('validation.attributes.password_confirmation'),
                            'label_class' => 'col-md-4',
                            'field_wrapper_class' => 'col-md-6',
                        ]) !!}

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                {!! Captcha::display() !!}
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
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