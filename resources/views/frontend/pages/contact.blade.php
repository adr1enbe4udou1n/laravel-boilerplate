@extends('layouts.frontend')

@section('title', trans('labels.frontend.titles.contact'))

@section('body_id', 'page-contact')

@section('content')

    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <form action="{{ route('contact') }}" method="POST" class="form-horizontal">
                {{ csrf_field() }}

                {!! form_row('text', [
                    'name' => 'name',
                    'required' => true,
                    'title' => trans('validation.attributes.name'),
                    'label_class' => 'col-md-3 col-sm-12',
                    'field_wrapper_class' => 'col-md-9 col-sm-12',
                ]) !!}

                <div class="form-group">
                    {{ Form::label('postal_code', trans('labels.frontend.form.postal_code_city'), ['class' =>  'col-md-3 col-sm-12 control-label']) }}

                    <div class="col-md-9 col-sm-12">
                        <div class="row">
                            {!! form_widget('text', [
                                'name' => 'postal_code',
                                'title' => trans('validation.attributes.postal_code'),
                                'wrapper_class' => 'col-md-6'
                            ]) !!}
                            {!! form_widget('text', [
                                'name' => 'city',
                                'title' => trans('validation.attributes.city'),
                                'wrapper_class' => 'col-md-6'
                            ]) !!}
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    {{ Form::label('email', trans('labels.frontend.form.email_and_phone'), ['class' =>  'col-md-3 col-sm-12 control-label']) }}

                    <div class="col-md-9 col-sm-12">
                        <div class="row">
                            {!! form_widget('email', [
                                'name' => 'email',
                                'required' => true,
                                'title' => trans('validation.attributes.email'),
                                'wrapper_class' => 'col-md-6'
                            ]) !!}
                            {!! form_widget('tel', [
                                'name' => 'phone',
                                'title' => trans('validation.attributes.phone'),
                                'wrapper_class' => 'col-md-6'
                            ]) !!}
                        </div>
                    </div>
                </div>

                {!! form_row('textarea', [
                    'name' => 'message',
                    'required' => true,
                    'title' => trans('validation.attributes.message'),
                    'label_class' => 'col-md-3 col-sm-12',
                    'field_wrapper_class' => 'col-md-9 col-sm-12',
                    'attributes' => [
                        'rows' => 5
                    ],
                ]) !!}

                <div class="form-group">
                    <div class="col-md-3 col-sm-12 col-md-offset-3">
                        {!! Captcha::display() !!}
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-3 col-sm-12 col-md-offset-3">
                        <input type="submit" class="btn btn-default" value="@lang('buttons.send')">
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    {!! Captcha::script() !!}
@endsection