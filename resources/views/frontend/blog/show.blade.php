@extends('layouts.frontend')

@section('meta_title', $post->meta_title)
@section('meta_description', $post->meta_description)
@section('title', $post->title)

@section('body_id', 'page-post')

@section('content')
    <div class="row">
        <div class="col-md-12">
            @lang('labels.frontend.blog.published_at', ['date' => $post->published_at->formatLocalized('%A %d %B %Y')])

            <div class="pull-left">
                <img src="{{ image_template_url('large', $post->featured_image_url) }}" alt="{{ $post->title }}">
            </div>

            {!! clean($post->body) !!}

            <nav class="navbar navbar-default">
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
        </div>
    </div>
@endsection
