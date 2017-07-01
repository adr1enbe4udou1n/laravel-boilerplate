@extends('layouts.frontend')

@section('title', trans('labels.frontend.titles.blog'))

@section('body_class', 'page-blog')

@section('content')
    @include('frontend.blog.partials.published-posts')
@endsection
