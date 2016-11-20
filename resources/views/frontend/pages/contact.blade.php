@extends('layouts.frontend')

@section('body_id', 'page-contact')

@section('content')
    <h1>Contact</h1>
    <form action="{{ route('contact') }}" method="POST" class="form-horizontal">
        {{ csrf_field() }}

        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
            <label for="name" class="col-md-2 col-sm-12 control-label">Votre nom</label>
            <div class="col-md-10 col-sm-12">
                <input id="name" name="name" class="form-control" type="text" placeholder="Votre nom">
                @if ($errors->has('name'))
                    <span class="help-block">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group{{ $errors->has('company') ? ' has-error' : '' }}">
            <label for="company" class="col-md-2 col-sm-12 control-label">Votre société</label>
            <div class="col-md-10 col-sm-12">
                <input id="company" name="company" class="form-control" type="text" placeholder="Votre société">
                @if ($errors->has('company'))
                    <span class="help-block">
                        <strong>{{ $errors->first('company') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group{{ $errors->has('city') ? ' has-error' : '' }}">
            <label for="city" class="col-md-2 col-sm-12 control-label">Localité</label>
            <div class="col-md-10 col-sm-12">
                <input id="city" name="city" class="form-control" type="text" placeholder="Localité">
                @if ($errors->has('city'))
                    <span class="help-block">
                        <strong>{{ $errors->first('city') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
            <label for="phone" class="col-md-2 col-sm-12 control-label">Votre téléphone</label>
            <div class="col-md-10 col-sm-12">
                <input id="phone" name="phone" class="form-control" type="tel" placeholder="Votre téléphone">
                @if ($errors->has('phone'))
                    <span class="help-block">
                        <strong>{{ $errors->first('phone') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
            <label for="email" class="col-md-2 col-sm-12 control-label">Votre E-mail</label>
            <div class="col-md-10 col-sm-12">
                <input id="email" name="email" class="form-control" type="email" placeholder="Votre E-mail">
                @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group{{ $errors->has('message') ? ' has-error' : '' }}">
            <label for="message" class="col-md-2 col-sm-12 control-label">Votre message</label>
            <div class="col-md-10 col-sm-12">
                <textarea id="message" name="message" class="form-control" rows="3" placeholder="Votre message"></textarea>
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
                <input type="submit" class="btn btn-default" value="Envoyer">
            </div>
        </div>
    </form>
@endsection

{!! Captcha::script() !!}
