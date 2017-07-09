@extends('backend.body')

@section('title', trans('labels.backend.form_settings.titles.edit'))

@section('content')
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="card">
                <div class="card-header">
                    <h3 class="box-title">@lang('labels.backend.form_settings.titles.edit')</h3>
                </div>
                {{ Form::model($form_setting, ['route' => ['admin.form_setting.update', $form_setting], 'form_setting' => 'form', 'method' => 'PATCH']) }}
                    @include('backend.form-setting.form')

                    <div class="card-footer">
                        <div class="row">
                            <div class="col-md-6">
                                <a href="{{ route('admin.form_setting.index') }}"
                                   class="btn btn-danger btn-sm">@lang('buttons.back')</a>
                            </div>
                            <div class="col-md-6">
                                {{ Form::submit(trans('buttons.edit'), ['class' => 'btn btn-success btn-sm pull-right']) }}
                            </div>
                        </div>
                    </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
@endsection
