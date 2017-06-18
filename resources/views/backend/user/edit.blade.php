@extends('backend.body')

@section('header_title', trans('labels.backend.users.titles.main'))
@section('header_description', trans('labels.backend.users.titles.edit'))

@section('content')
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">@lang('labels.backend.users.titles.edit')</h3>
                </div>
                {{ Form::model($user, ['route' => ['admin.user.update', $user], 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'PATCH']) }}
                    @include('backend.user.form')

                    <div class="box-footer">
                        <div class="pull-left">
                            <a href="{{ route('admin.user.index') }}"
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
