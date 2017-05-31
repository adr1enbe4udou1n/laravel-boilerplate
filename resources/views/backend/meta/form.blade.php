<div class="box-body">
    <div class="form-group{{ $errors->has('locale') ? ' has-error' : '' }}">
        {{ Form::label('locale', trans('validation.attributes.locale'), ['class' => 'col-lg-2 control-label']) }}

        <div class="col-lg-10">
            @foreach($locales as $code => $locale)
                <div class="radio icheck">
                    <label>
                        {{ Form::radio('locale', $code, isset($meta) && $meta->locale === $code) }} {{ trans($locale['name']) }}
                    </label>
                </div>
            @endforeach
            @if ($errors->has('locale'))
                <span class="help-block">
                    <strong>{{ $errors->first('locale') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="form-group{{ $errors->has('route') ? ' has-error' : '' }}">
        {{ Form::label('route', trans('validation.attributes.route'), ['class' => 'col-lg-2 control-label']) }}

        <div class="col-lg-10">
            @if(old('route'))
                @php($routeList = [old('route') => route(old('route'), [], false)])
            @else
                @php($routeList = isset($meta) ? [$meta->route => $meta->uri] : [])
            @endif

            {{ Form::select('route', $routeList, null, ['class' => 'select2-routes form-control', 'placeholder' => trans('labels.placeholder.route'), 'data-toggle' => 'tooltip', 'data-placement' => 'bottom', 'title' => trans('labels.descriptions.metas.route')]) }}
            @if ($errors->has('display_name'))
                <span class="help-block">
                    <strong>{{ $errors->first('display_name') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
        {{ Form::label('name', trans('validation.attributes.title'), ['class' => 'col-lg-2 control-label']) }}

        <div class="col-lg-10">
            {{ Form::text('title', null, ['class' => 'form-control', 'placeholder' => trans('validation.attributes.title')]) }}
            @if ($errors->has('title'))
                <span class="help-block">
                    <strong>{{ $errors->first('title') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
        {{ Form::label('name', trans('validation.attributes.description'), ['class' => 'col-lg-2 control-label']) }}

        <div class="col-lg-10">
            {{ Form::textarea('description', null, ['class' => 'form-control', 'placeholder' => trans('validation.attributes.description')]) }}
            @if ($errors->has('description'))
                <span class="help-block">
                    <strong>{{ $errors->first('description') }}</strong>
                </span>
            @endif
        </div>
    </div>
</div>