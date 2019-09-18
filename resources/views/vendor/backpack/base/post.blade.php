@extends('backpack::layout')
@section('content')
<h1>{{ $post->title }}</h1>
<br>
<img src="{{ asset('/'.$post->thumbnail) }}" alt="">

{!!
    $post->content
!!}
@hasrole('admin')
@if($post->publish == 0)
<button class="btn btn-success"><a href="{{ url('/admin/post/'.$post->slug.'/publish') }}" style="color:white;">Publish</a></button>
@endif
@if($post->publish == 1)
<button class="btn btn-success"><a href="{{ url('/admin/post/'.$post->slug.'/unpublish') }}" style="color:white;">Unpublish</a></button>
@endif
@endhasrole
<button class="btn btn-danger"><a href="{{ url('/admin/post') }}" style="color:white;">Go back</a></button>
@endsection