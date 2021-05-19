@extends('layouts.app')

@section('title', 'post')

@section('content')

<h1>sono il post</h1>


<h3>{{$post['title']}}</h3>
<p>{{$post['text']}}</p>
<p>{{$post['author']}}</p>


    
@endsection