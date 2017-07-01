@extends('layouts.frontend')

@section('title', $tag->name)

@section('body_class', 'page-blog')

@section('content')
    @include('frontend.blog.partials.published-posts')
@endsection
