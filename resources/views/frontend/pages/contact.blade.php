@extends('layouts.frontend')

@section('title', __('labels.frontend.titles.contact'))

@section('body_class', 'page-contact')

@section('content')

    <div class="row">
        <div class="col-md-6">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d317718.69319292053!2d-0.3817765050863085!3d51.528307984912544!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47d8a00baf21de75%3A0x52963a5addd52a99!2sLondres%2C+Royaume-Uni!5e0!3m2!1sfr!2sfr!4v1496781964517"
                    height="550" frameborder="0" allowfullscreen></iframe>
        </div>
        <div class="col-md-6">
            <form action="{{ route('contact') }}" method="POST">
                {{ csrf_field() }}

                @component('components.form-group', [
                    'name' => 'name',
                    'title' => __('validation.attributes.name'),
                ])
                    <input name="name" placeholder="@lang('validation.attributes.name')" class="form-control {{ is_invalid('name') }}" :class="{'is-invalid': errors.has('name') }" required v-validate="'required'" value="{{ old('name') }}">
                @endcomponent

                <div class="row">
                    <div class="col-sm-6">
                        @component('components.form-group', [
                            'name' => 'postal_code',
                            'title' => __('validation.attributes.postal_code'),
                        ])
                            <input name="postal_code" placeholder="@lang('validation.attributes.postal_code')" class="form-control" value="{{ old('postal_code') }}">
                        @endcomponent
                    </div>
                    <div class="col-sm-6">
                        @component('components.form-group', [
                            'name' => 'city',
                            'title' => __('validation.attributes.city'),
                        ])
                            <input name="city" placeholder="@lang('validation.attributes.city')" class="form-control" value="{{ old('city') }}">
                        @endcomponent
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        @component('components.form-group', [
                            'name' => 'email',
                            'title' => __('validation.attributes.email'),
                        ])
                            <input type="email" name="email" placeholder="@lang('validation.attributes.email')" class="form-control {{ is_invalid('email') }}" :class="{'is-invalid': errors.has('email') }" required v-validate="'required|email'" value="{{ old('email') }}">
                        @endcomponent
                    </div>
                    <div class="col-sm-6">
                        @component('components.form-group', [
                            'name' => 'phone',
                            'title' => __('validation.attributes.phone'),
                        ])
                            <input type="tel" name="phone" placeholder="@lang('validation.attributes.phone')" class="form-control {{ is_invalid('phone') }}" :class="{'is-invalid': errors.has('phone') }" v-validate="'phone'" value="{{ old('phone') }}">
                        @endcomponent
                    </div>
                </div>

                @component('components.form-group', [
                    'name' => 'message',
                    'title' => __('validation.attributes.message'),
                ])
                    <textarea name="message" placeholder="@lang('validation.attributes.message')" class="form-control {{ is_invalid('message') }}" :class="{'is-invalid': errors.has('message') }" rows="5" required v-validate="'required'">
                        {{ old('message') }}
                    </textarea>
                @endcomponent

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

@push('scripts')
    {!! Captcha::script() !!}
@endpush
