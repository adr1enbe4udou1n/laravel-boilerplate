@extends('backend.body')

@section('title', trans('labels.backend.posts.titles.edit'))

@section('content')
    {{ Form::model($post, ['route' => ['admin.post.update', $post], 'class' => 'form-horizontal', 'post' => 'form', 'method' => 'PATCH', 'files' => true]) }}
    <div class="row">
        @include('backend.post.form', [
            'title' => trans('labels.backend.posts.titles.edit')
        ])
    </div>
    {{ Form::close() }}
@endsection
