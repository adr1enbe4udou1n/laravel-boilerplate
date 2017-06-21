@extends('layouts.frontend')

@section('title', $post->title)
@section('description', $post->summary)

@section('body_id', 'page-post')

@section('content')
    <div class="row">
        <div class="col-md-12">
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

            <div class="pull-left">
                <img src="{{ image_template_url('medium', $post->featured_image_url) }}" alt="{{ $post->title }}">
            </div>

            {!! clean($post->body) !!}
        </div>
    </div>
@endsection
