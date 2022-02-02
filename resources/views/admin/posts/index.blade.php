@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
      <h2>Elenco posts</h2>
      <table class="table">
        <thead>
          <tr>
            <th scope="col">ID</th>
            <th scope="col">Title</th>
            <th scope="col">Content</th>
            <th scope="col">Handle</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($posts as $post)
          <tr>
            <th scope="row">{{$post->id}}</th>
            <td>{{$post->title}}</td>
            <td>{{$post->content}}</td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
</div>
@endsection