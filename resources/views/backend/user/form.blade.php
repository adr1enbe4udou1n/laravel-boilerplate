<div class="box-body">
    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
        {{ Form::label('email', trans('validation.attributes.email'), ['class' => 'col-lg-2 control-label']) }}

        <div class="col-lg-10">
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                {{ Form::text('email', null, ['class' => 'form-control', 'placeholder' => trans('validation.attributes.email')]) }}
            </div>
            @if ($errors->has('email'))
                <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="form-group">
        <div class="col-lg-offset-2 col-lg-10">
            <div class="checkbox icheck">
                <label>
                    {{ Form::hidden('active', 0) }}
                    {{ Form::checkbox('active', 1) }} @lang('validation.attributes.active')
                </label>
            </div>
        </div>
    </div>
    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
        {{ Form::label('name', trans('validation.attributes.name'), ['class' => 'col-lg-2 control-label']) }}

        <div class="col-lg-10">
            {{ Form::text('name', null, ['class' => 'form-control', 'placeholder' => trans('validation.attributes.name')]) }}
            @if ($errors->has('name'))
                <span class="help-block">
                    <strong>{{ $errors->first('name') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="form-group{{ $errors->has('roles') ? ' has-error' : '' }}">
        {{ Form::label('roles[]', trans('validation.attributes.roles'), ['class' => 'col-lg-2 control-label']) }}

        <div class="col-lg-10">
            @foreach($roles->get() as $role)
                <div class="checkbox icheck">
                    <label>
                        {{ Form::checkbox('roles[]', $role->id, isset($user) && $user->hasRole($role->name) ? true : false) }} {{ $role }}
                    </label>
                </div>
            @endforeach
            @if ($errors->has('roles'))
                <span class="help-block">
                    <strong>{{ $errors->first('roles') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
        {{ Form::label('password', trans('validation.attributes.password'), ['class' => 'col-lg-2 control-label']) }}

        <div class="col-lg-10">
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-key"></i></span>
                {{ Form::password('password', ['class' => 'form-control', 'placeholder' => trans('validation.attributes.password')]) }}
            </div>
            @if ($errors->has('password'))
                <span class="help-block">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
        {{ Form::label('password_confirmation', trans('validation.attributes.password_confirmation'), ['class' => 'col-lg-2 control-label']) }}

        <div class="col-lg-10">
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-key"></i></span>
                {{ Form::password('password_confirmation', ['class' => 'form-control', 'placeholder' => trans('validation.attributes.password_confirmation')]) }}
            </div>
            @if ($errors->has('password_confirmation'))
                <span class="help-block">
                    <strong>{{ $errors->first('password_confirmation') }}</strong>
                </span>
            @endif
        </div>
    </div>
</div>