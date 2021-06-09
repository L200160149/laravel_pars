@extends('layouts.app')

@section('title',$post->title)

@section('content')
    <div class="container">
        <h1>{{$post->title}}</h1>

        <div class="text-success">Kategori : <a href="/categories/{{ $post->category->slug }}">{{ $post->category->name }}</a>  &middot; {{ $post->created_at->format('d M, Y') }}</div>
        <hr>

        <p>{{$post->body}}</p>
    </div>
@endsection