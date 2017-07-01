@extends('layouts.frontend')

@section('title', $user->name)

@section('body_class', 'page-blog')

@section('content')
    @include('frontend.blog.partials.published-posts', ['hide_owner' => true])
@endsection
