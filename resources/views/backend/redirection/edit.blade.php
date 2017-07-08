@extends('backend.body')

@section('title', trans('labels.backend.redirections.titles.edit'))

@section('content')
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">@lang('labels.backend.redirections.titles.edit')</h3>
                </div>
                {{ Form::model($redirection, ['route' => ['admin.redirection.update', $redirection], 'class' => 'form-horizontal', 'redirection' => 'form', 'method' => 'PATCH']) }}
                    @include('backend.redirection.form')

                    <div class="box-footer">
                        <div class="pull-left">
                            <a href="{{ route('admin.redirection.index') }}"
                               class="btn btn-danger btn-sm">@lang('buttons.back')</a>
                        </div>
                        <div class="pull-right">
                            {{ Form::submit(trans('buttons.edit'), ['class' => 'btn btn-success btn-sm']) }}
                        </div>
                    </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
@endsection
