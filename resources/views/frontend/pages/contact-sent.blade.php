@extends('layouts.frontend')

@section('title', trans('labels.frontend.titles.message_sent'))

@section('body_id', 'page-contact')

@section('content')
    @if(!empty($message))
    {!! $message !!}
    @endif
@endsection
