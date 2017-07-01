@extends('layouts.frontend')

@section('meta_title', $post->meta_title)
@section('meta_description', $post->meta_description)

@section('body_class', 'page-post')

@section('highlight')
    <div class="cover">
        <img src="{{ $post->featured_image_url }}" alt="{{ $post->title }}" class="img-responsive">
    </div>
    <div class="post-title">
        <h1>{{ $post->title }}</h1>
        @include('frontend.blog.partials.publication-infos')
    </div>
@endsection

@section('content')
    <nav class="navbar navbar-default navbar-tags">
        <div class="navbar-header">
            <span class="navbar-brand">@lang('labels.frontend.blog.tags')</span>
        </div>

        <div>
            <ul class="nav navbar-nav">
                @foreach($post->tags as $tag)
                    <li><a href="{{ route('blog.tag', $tag->slug) }}">{{ $tag->name }}</a></li>
                @endforeach
            </ul>
        </div>
    </nav>

    <div class="post-body">
        {!! clean($post->body) !!}
    </div>
@endsection
