{{ Form::model($logged_in_user, ['route' => 'user.account.update', 'class' => 'form-horizontal', 'method' => 'PATCH']) }}

<div class="form-group">
    {{ Form::label('name', trans('validation.attributes.name'),
    ['class' => 'col-md-4 control-label']) }}
    <div class="col-md-6">
        {{ Form::text('name', null,
        ['class' => 'form-control', 'required' => 'required', 'autofocus' => 'autofocus', 'maxlength' => '191', 'placeholder' => trans('validation.attributes.name')]) }}
    </div>
</div>

<div class="form-group">
    {{ Form::label('email', trans('validation.attributes.email'), ['class' => 'col-md-4 control-label']) }}
    <div class="col-md-6">
        {{ Form::email('email', null, ['class' => 'form-control', 'required' => 'required', 'maxlength' => '191', 'placeholder' => trans('validation.attributes.frontend.email')]) }}
    </div>
</div>

<div class="form-group">
    <div class="col-md-6 col-md-offset-4">
        {{ Form::submit(trans('buttons.update'), ['class' => 'btn btn-primary', 'id' => 'update-profile']) }}
    </div>
</div>

{{ Form::close() }}