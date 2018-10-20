@extends('layouts.frontend')

@section('body_class', 'page-post')

@section('highlight')
    <div class="cover">
        @if ($post->featured_image_url)
            <img src="{{ image_template_url($post->featured_image_url, ['w' => 1800, 'h' => 600, 'fit' => 'crop']) }}" alt="{{ $post->title }}" class="img-fluid">
        @endif
    </div>
    <div class="post-title">
        <h1 class="pb-3 pt-2">{{ $post->title }}</h1>
        <div class="publication-infos">
            @include('frontend.blog.partials.publication-infos')
        </div>
    </div>
@endsection

@section('content')
    <div class="wysiwyg-content">
        {!! Purify::clean($post->body) !!}
    </div>

    <nav class="nav">
        <span class="navbar-brand">@lang('labels.frontend.blog.tags')</span>

        @foreach($post->tags as $tag)
        <a class="nav-link" href="{{ route('blog.tag', $tag->slug) }}">{{ $tag->name }}</a>
        @endforeach
    </nav>
@endsection
