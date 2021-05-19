@extends('layouts.app')

@section('title', 'post')

@section('content')

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
        </ul>
    </div>
@endif

<form action="{{route('posts.store')}}" method="post">
    @csrf
    @method('POST')
    <div class="form-group">
      <label for="title">Title:</label>
      <input type="text" class="form-control" id="title" name="title">
    </div>
    <div class="form-group">
      <label for="text">Content:</label>
      <textarea class="form-control" name="text"></textarea>
    </div>
    <div class="form-group">
      <label for="author">Author:</label>
      <input type="text" id="author" name="author">
      
    </div>
    <button type="submit" class="btn btn-success">Invia</button>

  </form>


    
@endsection