@extends('layouts.frontend')

@section('body_id', 'page-contact')

@section('title')
    <h1>@lang('labels.frontend.titles.contact')</h1>
@endsection

@section('content')
    <form action="{{ route('contact') }}" method="POST" class="form-horizontal">
        {{ csrf_field() }}

        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
            <label for="name" class="col-md-2 col-sm-12 control-label">@lang('validation.attributes.name')</label>
            <div class="col-md-10 col-sm-12">
                <input id="name" name="name" class="form-control" type="text" placeholder="@lang('validation.attributes.name')" value="{{ old('name') }}">
                @if ($errors->has('name'))
                    <span class="help-block">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group{{ $errors->has('city') ? ' has-error' : '' }}">
            <label for="city" class="col-md-2 col-sm-12 control-label">@lang('validation.attributes.city')</label>
            <div class="col-md-10 col-sm-12">
                <input id="city" name="city" class="form-control" type="text" placeholder="@lang('validation.attributes.city')" value="{{ old('city') }}">
                @if ($errors->has('city'))
                    <span class="help-block">
                        <strong>{{ $errors->first('city') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
            <label for="phone" class="col-md-2 col-sm-12 control-label">@lang('validation.attributes.phone')</label>
            <div class="col-md-10 col-sm-12">
                <input id="phone" name="phone" class="form-control" type="tel" placeholder="@lang('validation.attributes.phone')" value="{{ old('phone') }}">
                @if ($errors->has('phone'))
                    <span class="help-block">
                        <strong>{{ $errors->first('phone') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
            <label for="email" class="col-md-2 col-sm-12 control-label">@lang('validation.attributes.email')</label>
            <div class="col-md-10 col-sm-12">
                <input id="email" name="email" class="form-control" type="email" placeholder="@lang('validation.attributes.email')" value="{{ old('email') }}">
                @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group{{ $errors->has('message') ? ' has-error' : '' }}">
            <label for="message" class="col-md-2 col-sm-12 control-label">@lang('validation.attributes.message')</label>
            <div class="col-md-10 col-sm-12">
                <textarea id="message" name="message" class="form-control" rows="3" placeholder="@lang('validation.attributes.message')">{{ old('message') }}</textarea>
                @if ($errors->has('message'))
                    <span class="help-block">
                        <strong>{{ $errors->first('message') }}</strong>
                    </span>
                @endif
            </div>
        </div>

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