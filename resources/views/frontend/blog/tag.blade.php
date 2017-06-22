@extends('layouts.frontend')

@section('title', trans('labels.frontend.titles.blog'))

@section('body_id', 'page-blog')

@section('content')
    <div class="row">
        @include('frontend.blog.partials.published-posts')
    </div>
@endsection
