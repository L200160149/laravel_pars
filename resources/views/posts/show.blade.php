@extends('layouts.app')

@section('title',$post->title)

@section('content')
    <div class="container">
        <h1>{{$post->title}}</h1>

        <div class="text-success">Kategori : {{ $post->category->name }} &middot; {{ $post->created_at->format('d M, Y') }}</div>
        <hr>

        <p>{{$post->body}}</p>
    </div>
@endsection