@extends('backend.body')

@section('title', trans('labels.backend.roles.titles.main'))
@section('header_description', trans('labels.backend.roles.titles.create'))

@section('content')
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">
                    <h3 class="box-title">@lang('labels.backend.roles.titles.create')</h3>
                </div>
                {{ Form::open(['route' => 'admin.role.store', 'role' => 'form', 'method' => 'POST']) }}
                    @include('backend.role.form')

                    <div class="card-footer">
                        <div class="row">
                            <div class="col-md-6">
                                <a href="{{ route('admin.role.index') }}" class="btn btn-danger btn-sm">@lang('buttons.back')</a>
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
