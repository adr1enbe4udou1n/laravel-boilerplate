@extends('layouts.frontend')

@section('body_class', 'page-post')

@section('highlight')
    <div class="cover">
        <img src="{{ $post->featured_image_path }}" alt="{{ $post->title }}" class="img-fluid">
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

    <div>
        <b-button-toolbar>
            <b-button-group class="mx-1">
                <v-add-to-favourite
                    :checked='{{ json_encode($post->isFavourite ? true : false) }}'
                    :item-id='{{ $post->id }}'
                    class="btn-inverse"
                ></v-add-to-favourite>
                <v-social-share
                    url="{{ route('blog.show', ['post' => $post->slug]) }}"
                    title="{{ $post->title }}"
                    description="{{ $post->description }}"
                    :tags="{{ json_encode(array_map(function ($tag) { return $tag['name']; }, $post->tags->toArray())) }}"
                ></v-social-share>
            </b-button-group>
        </b-button-toolbar>
    </div>

    <nav class="nav">
        <span class="navbar-brand">@lang('labels.frontend.blog.tags')</span>

        @foreach($post->tags as $tag)
        <a class="nav-link" href="{{ route('blog.tag', $tag->slug) }}">{{ $tag->name }}</a>
        @endforeach
    </nav>
@endsection
