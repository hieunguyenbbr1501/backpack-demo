
<h1>{{ $post->title }}</h1>
<br>
<img src="{{ asset('/'.$post->thumbnail) }}" alt="">

{!!
    $post->content
!!}