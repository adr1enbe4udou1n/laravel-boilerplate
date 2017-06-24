@extends('backend.body')

@section('header_title', trans('labels.backend.posts.titles.main'))
@section('header_description', trans('labels.backend.posts.titles.edit'))

@section('content')
    {{ Form::model($post, ['route' => ['admin.post.update', $post], 'class' => 'form-horizontal', 'post' => 'form', 'method' => 'PATCH']) }}
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">@lang('labels.backend.posts.titles.edit')</h3>
                </div>
                @include('backend.post.form')
            </div>
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">@lang('labels.backend.titles.metas')</h3>
                </div>
                @include('backend.partials.metas')
            </div>
            <div class="box box-info">
                <div class="box-body">
                    <div class="pull-left">
                        <a href="{{ route('admin.post.index') }}"
                           class="btn btn-danger btn-sm">@lang('buttons.back')</a>
                    </div>
                    <div class="pull-right">
                        {{ Form::submit(trans('buttons.edit'), ['class' => 'btn btn-success btn-sm']) }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{ Form::close() }}
@endsection
