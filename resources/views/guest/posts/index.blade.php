@extends('layouts.app')

@section('title', 'posts')

@section('content')

<h1>sono la lista post</h1>


@foreach ($posts as $post)

<h3>{{$post['title']}}</h3>

<a href="{{route('posts.show', ['slug' => $post->slug])}}" class="btn btn-primary">Visualizza</a>
    
@endforeach
    
@endsection