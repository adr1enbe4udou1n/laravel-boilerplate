@extends('backend.body')

@section('title', trans('labels.backend.users.titles.edit'))

@section('content')
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="card">
                <div class="card-header">
                    <h4>@lang('labels.backend.users.titles.edit')</h4>
                </div>
                {{ Form::model($user, ['route' => ['admin.user.update', $user], 'role' => 'form', 'method' => 'PATCH']) }}
                    @include('backend.user.form')

                    <div class="card-footer">
                        <div class="row">
                            <div class="col-md-6">
                                <a href="{{ route('admin.user.index') }}"
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
