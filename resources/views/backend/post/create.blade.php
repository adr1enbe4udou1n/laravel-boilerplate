@extends('backend.body')

@section('title', trans('labels.backend.posts.titles.create'))

@section('content')
    {{ Form::open(['route' => 'admin.post.store', 'class' => 'form-horizontal', 'post' => 'form', 'method' => 'POST']) }}
    <div class="row">
        @include('backend.post.form', [
            'title' => trans('labels.backend.posts.titles.create')
        ])
    </div>
    {{ Form::close() }}
@endsection
