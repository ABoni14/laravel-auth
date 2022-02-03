@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Create new Post</h2>

    @if ($errors->any())
    <div class="alert alert-danger" role="alert">
      <ul>
        @foreach ($errors->all() as $error)
          <li>{{$error}}</li>
        @endforeach
      </ul>
    </div>
    @endif
    

    <form action="{{route("admin.posts.store")}}" method="POST">
      @csrf
      <div class="form-group">
        <label for="title">Title</label>
        <input type="text" 
        value="{{old("title")}}"
        class="form-control @error('title') is-invalid @enderror" 
        id="title" name="title"
        placeholder="Enter title">
        @error("title")
          <h6>{{$message}}</h6>
        @enderror
      </div>
      <div class="form-group">
        <label for="content">Content</label>
        <textarea 
        class="form-control @error('content') is-invalid @enderror" 
        id="content" name="content"
        placeholder="Enter content">{{old("content")}}
        </textarea>
        @error("content")
        <h6>{{$message}}</h6>
      @enderror
      </div>
      <button type="submit" class="btn btn-primary">Send</button>
      <button type="reset" class="btn btn-dark">Reset</button>
    </form>
</div>
@endsection