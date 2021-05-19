@extends('layouts.app')

@section('title', 'posts')

@section('content')

<h1>sono la lista post</h1>
<a href="{{route('posts.create')}}" class="btn btn-warning">Crea post</a>

@foreach ($posts as $post)

<h3>{{$post['title']}}</h3>

<a href="{{route('posts.show', ['post' => $post -> id])}}" class="btn btn-primary">Visualizza</a>
<a href="{{route('posts.edit', ['post' => $post -> id])}}" class="btn btn-warning">Modifica</a>
<form action="{{route('posts.destroy', ['post' => $post -> id])}}" method="post">
    @csrf
    @method('DELETE')
    <button type="submit"  class="btn btn-danger">Elimina</button>

</form>
    
@endforeach
    
@endsection