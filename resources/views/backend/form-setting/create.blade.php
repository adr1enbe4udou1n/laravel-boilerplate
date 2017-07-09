@extends('backend.body')

@section('title', trans('labels.backend.form_settings.titles.create'))

@section('content')
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="card">
                <div class="card-header">
                    <h3 class="box-title">@lang('labels.backend.form_settings.titles.create')</h3>
                </div>
                {{ Form::open(['route' => 'admin.form_setting.store', 'form_setting' => 'form', 'method' => 'POST']) }}
                    @include('backend.form-setting.form')

                    <div class="card-footer">
                        <div class="row">
                            <div class="col-md-6">
                                <a href="{{ route('admin.form_setting.index') }}" class="btn btn-danger btn-sm">@lang('buttons.back')</a>
                            </div>
                            <div class="col-md-6">
                                {{ Form::submit(trans('buttons.create'), ['class' => 'btn btn-success btn-sm pull-right']) }}
                            </div>
                        </div>
                    </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
@endsection
