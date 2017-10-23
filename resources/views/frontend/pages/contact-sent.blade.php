@extends('layouts.frontend')

@section('title', __('labels.frontend.titles.message_sent'))

@section('body_class', 'page-contact')

@section('content')
    @if(!empty($message))
    {!! $message !!}
    @endif
@endsection
