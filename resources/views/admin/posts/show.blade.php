@extends('layouts.app')

@section('content')
<div class="container">
    <h2>{{ $post->title }}</h2>
    <p>{{ $post->content }}</p>
    
    <div>
      <a href="{{route("admin.posts.edit", $post)}}" class="btn btn-warning">EDIT</a>
    </div>
</div>
@endsection