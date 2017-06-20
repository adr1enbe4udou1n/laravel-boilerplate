@extends('layouts.frontend')

@section('title', $post->title)

@section('body_id', 'page-post')

@section('highlight')
    @component('frontend.components.highlight')

    @endcomponent
@endsection

@section('content')
    <div class="row">

    </div>
@endsection
