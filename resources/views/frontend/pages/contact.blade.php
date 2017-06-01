@extends('layouts.frontend')

@section('title', trans('labels.frontend.titles.contact'))

@section('body_id', 'page-contact')

@section('content')
    <form action="{{ route('contact') }}" method="POST" class="form-horizontal">
        {{ csrf_field() }}

        @include('partials.form.widgets.input', [
            'type' => 'text',
            'name' => 'name',
            'title' => trans('validation.attributes.name'),
            'label_class' => 'col-md-2 col-sm-12',
            'field_wrapper_class' => 'col-md-10 col-sm-12',
        ])

        @include('partials.form.widgets.input', [
            'type' => 'text',
            'name' => 'city',
            'title' => trans('validation.attributes.city'),
            'label_class' => 'col-md-2 col-sm-12',
            'field_wrapper_class' => 'col-md-10 col-sm-12',
        ])

        @include('partials.form.widgets.input', [
            'type' => 'text',
            'name' => 'phone',
            'title' => trans('validation.attributes.phone'),
            'label_class' => 'col-md-2 col-sm-12',
            'field_wrapper_class' => 'col-md-10 col-sm-12',
        ])

        @include('partials.form.widgets.input', [
            'type' => 'text',
            'name' => 'email',
            'title' => trans('validation.attributes.email'),
            'label_class' => 'col-md-2 col-sm-12',
            'field_wrapper_class' => 'col-md-10 col-sm-12',
        ])

        @include('partials.form.widgets.textarea', [
            'type' => 'text',
            'name' => 'message',
            'title' => trans('validation.attributes.message'),
            'label_class' => 'col-md-2 col-sm-12',
            'field_wrapper_class' => 'col-md-10 col-sm-12',
            'attributes' => [
                'rows' => 5
            ],
        ])

        <div class="form-group">
            <div class="col-md-2 col-sm-12 col-md-offset-2">
                {!! Captcha::display() !!}
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-2 col-sm-12 col-md-offset-2">
                <input type="submit" class="btn btn-default" value="@lang('buttons.send')">
            </div>
        </div>
    </form>
@endsection

@section('scripts')
    {!! Captcha::script() !!}
@endsection