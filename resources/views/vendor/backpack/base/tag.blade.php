@extends('backpack::layout')
@section('content')
<div style="display:flex; justify-content:space-around;">
@foreach($post as $p)
<div class="card shadow p-3 mb-5 bg-white rounded" style="width: 18rem">
  <img src="{{ asset('/' .$p->thumbnail) }}" class="card-img-top" alt="...">
  <div class="card-body">
    <h5 class="card-title">{{ $p->title }}</h5>
    <p class="card-text">...</p>
    <a href="{{ url('/admin/post/'.$p->slug) }}" class="btn btn-primary">Check out</a>
  </div>
</div>
@endforeach
</div>
@endsection