@extends('backend.body')

@section('title', trans('labels.backend.users.titles.create'))

@section('content')
    <div class="row">
        <div class="col-md-4 offset-md-4">
            <div class="card">
                <div class="card-header">
                    <h3 class="box-title">@lang('labels.backend.users.titles.create')</h3>
                </div>
                {{ Form::open(['route' => 'admin.user.store', 'role' => 'form', 'method' => 'POST']) }}
                    @include('backend.user.form')

                    <div class="card-footer">
                        <div class="row">
                            <div class="col-md-6">
                                <a href="{{ route('admin.user.index') }}" class="btn btn-danger btn-sm">@lang('buttons.back')</a>
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
