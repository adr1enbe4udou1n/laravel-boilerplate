@extends('layouts.frontend')

@section('title', $user->name)

@section('body_id', 'page-user')

@section('content')
    <div class="row">
        @include('frontend.blog.partials.published-posts', ['hide_owner' => true])
    </div>
@endsection
