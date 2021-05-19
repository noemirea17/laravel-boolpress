@extends('layouts.app')

@section('title', 'post')

@section('content')


<form action="{{route('posts.update', $post->id)}}" method="post">
    @csrf
    @method('PUT')
    <div class="form-group">
      <label for="title">Title:</label>
      <input type="text" class="form-control" id="title" name="title" value="{{$post['title']}}">
    </div>
    <div class="form-group">
      <label for="text">Content:</label>
      <textarea class="form-control" name="text">{{$post['text']}}</textarea>
    </div>
    <div class="form-group">
      <label for="author">Author:</label>
      <input type="text" id="author" name="author" value="{{$post['author']}}">
      
    </div>
    <button type="submit" class="btn btn-success">Invia</button>

  </form>


    
@endsection