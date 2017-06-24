@extends('backend.body')

@section('header_title', trans('labels.backend.posts.titles.main'))
@section('header_description', trans('labels.backend.posts.titles.create'))

@section('content')
    {{ Form::open(['route' => 'admin.post.store', 'class' => 'form-horizontal', 'post' => 'form', 'method' => 'POST']) }}
    <div class="row">
        @include('backend.post.form', [
            'title' => trans('labels.backend.posts.titles.create')
        ])
    </div>
    {{ Form::close() }}
@endsection
