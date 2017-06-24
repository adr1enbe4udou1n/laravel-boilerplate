@extends('backend.body')

@section('header_title', trans('labels.backend.posts.titles.main'))
@section('header_description', trans('labels.backend.posts.titles.create'))

@section('content')
    <div class="row">
        <!-- left column -->
        <div class="col-md-6 col-md-offset-3">
            <!-- Horizontal Form -->
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">@lang('labels.backend.posts.titles.create')</h3>
                </div>
                {{ Form::open(['route' => 'admin.post.store', 'class' => 'form-horizontal', 'post' => 'form', 'method' => 'POST']) }}
                    @include('backend.post.form')

                    <div class="box-footer">
                        <div class="pull-left">
                            <a href="{{ route('admin.post.index') }}" class="btn btn-danger btn-sm">@lang('buttons.back')</a>
                        </div>
                        <div class="pull-right">
                            {{ Form::submit(trans('buttons.create'), ['class' => 'btn btn-success btn-sm']) }}
                        </div>
                    </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
@endsection
