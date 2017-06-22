@extends('layouts.frontend')

@section('title', $tag->name)

@section('body_id', 'page-blog')

@section('content')
    <div class="row">
        @include('frontend.blog.partials.published-posts')
    </div>
@endsection
