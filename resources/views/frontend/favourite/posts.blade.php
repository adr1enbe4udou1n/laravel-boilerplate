@extends('layouts.frontend')

@section('title', __('labels.frontend.titles.favourite.' . $type))

@section('body_class', 'page-blog')

@section('content')
    @include('frontend.favourite.partials.' . $type)
@endsection
