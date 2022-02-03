@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
      <h2>Elenco posts</h2>
      @if (session("deleted"))
        <div class="alert alert-danger" role="alert">
          {{session("deleted")}}
        </div>
      @endif
      <table class="table">
        <thead>
          <tr>
            <th scope="col">ID</th>
            <th scope="col">Title</th>
            <th scope="col">Content</th>
            <th scope="col">Show</th>
            <th scope="col">Edit</th>
            <th scope="col">Delete</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($posts as $post)
          <tr>
            <th scope="row">{{$post->id}}</th>
            <td>{{$post->title}}</td>
            <td>{{$post->content}}</td>
            <td><a href="{{route("admin.posts.show", $post)}}" class="btn btn-primary">SHOW</a></td>
            <td><a href="{{route("admin.posts.edit", $post)}}" class="btn btn-warning">EDIT</a></td>
            <td>
              <form onsubmit="return confirm('Vuoi davvero eliminare: {{$post->title}}')"
              action="{{route('admin.posts.destroy', $post)}}"
              method="POST">
                @csrf
                @method("DELETE")
                <button type="submit" class="btn btn-danger">DELETE</button>
              </form>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
      {{$posts->links()}}
    </div>
</div>
@endsection

@section("title")
    | Elenco post
@endsection