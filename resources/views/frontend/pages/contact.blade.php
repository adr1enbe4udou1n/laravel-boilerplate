@extends('layouts.frontend')

@section('title', trans('labels.frontend.titles.contact'))

@section('body_id', 'page-contact')

@section('content')

    <div class="row">
        <div class="col-md-6">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d317718.69319292053!2d-0.3817765050863085!3d51.528307984912544!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47d8a00baf21de75%3A0x52963a5addd52a99!2sLondres%2C+Royaume-Uni!5e0!3m2!1sfr!2sfr!4v1496781964517"
                    height="550" frameborder="0" allowfullscreen></iframe>
        </div>
        <div class="col-md-6">
            <form action="{{ route('contact') }}" method="POST">
                {{ csrf_field() }}

                {{ Form::bsText('name', [
                    'required' => true,
                    'title' => trans('validation.attributes.name'),
                ]) }}

                <div class="row">
                    <div class="col-sm-6">
                        {{ Form::bsText('postal_code', [
                            'title' => trans('validation.attributes.postal_code'),
                        ]) }}
                    </div>
                    <div class="col-sm-6">
                        {{ Form::bsText('city', [
                            'title' => trans('validation.attributes.city'),
                        ]) }}
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        {{ Form::bsText('email', [
                            'required' => true,
                            'type' => 'email',
                            'title' => trans('validation.attributes.email'),
                            'input_group_prefix' => '<i class="fa fa-envelope"></i>',
                        ]) }}
                    </div>
                    <div class="col-sm-6">
                        {{ Form::bsText('phone', [
                            'type' => 'tel',
                            'title' => trans('validation.attributes.phone'),
                        ]) }}
                    </div>
                </div>

                {{ Form::bsTextarea('message', [
                    'required' => true,
                    'title' => trans('validation.attributes.message'),
                    'attributes' => [
                        'rows' => 5
                    ],
                ]) }}

                <div class="form-group">
                    {!! Captcha::display() !!}
                </div>

                <div class="form-group">
                    <input type="submit" class="btn btn-default" value="@lang('buttons.send')">
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    {!! Captcha::script() !!}
@endsection