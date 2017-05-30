<div class="box-body">
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
    <div class="form-group{{ $errors->has('display_name') ? ' has-error' : '' }}">
        {{ Form::label('display_name', trans('validation.attributes.display_name'), ['class' => 'col-lg-2 control-label']) }}

        <div class="col-lg-10">
            {{ Form::text('display_name', null, ['class' => 'form-control', 'placeholder' => trans('validation.attributes.display_name')]) }}
            @if ($errors->has('display_name'))
                <span class="help-block">
                    <strong>{{ $errors->first('display_name') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
        {{ Form::label('name', trans('validation.attributes.description'), ['class' => 'col-lg-2 control-label']) }}

        <div class="col-lg-10">
            {{ Form::text('description', null, ['class' => 'form-control', 'placeholder' => trans('validation.attributes.description')]) }}
            @if ($errors->has('description'))
                <span class="help-block">
                    <strong>{{ $errors->first('description') }}</strong>
                </span>
            @endif
        </div>
    </div>
</div>