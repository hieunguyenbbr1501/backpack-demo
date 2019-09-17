@extends('backpack::layout')
@section('content')
{{ $post->title }}
{{ $post->thumbnail }}
{!!
    $post->content
!!}
@endsection