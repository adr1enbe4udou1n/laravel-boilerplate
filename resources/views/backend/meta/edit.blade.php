@extends('backend.body')

@section('header_title', trans('labels.backend.metas.titles.main'))
@section('header_description', trans('labels.backend.metas.titles.edit'))

@section('content')
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">@lang('labels.backend.metas.titles.edit')</h3>
                </div>
                {{ Form::model($meta, ['route' => ['admin.meta.update', $meta], 'class' => 'form-horizontal', 'meta' => 'form', 'method' => 'PATCH']) }}
                    @include('backend.meta.form')

                    <div class="box-footer">
                        <div class="pull-left">
                            <a href="{{ route('admin.meta.index') }}"
                               class="btn btn-danger btn-xs">@lang('buttons.back')</a>
                        </div>
                        <div class="pull-right">
                            {{ Form::submit(trans('buttons.edit'), ['class' => 'btn btn-success btn-xs']) }}
                        </div>
                    </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
@endsection
