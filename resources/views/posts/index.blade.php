@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between">
            <div>
                <h4>All Posts</h4>
                <hr>
            </div>
            <div>
                <a href="/posts/create" class="btn btn-primary">New Post</a>
            </div>
        </div>

        @if(session()->has('success'))
            <div class="alert alert-success">
                {{ session()->get('success') }}
            </div>
        @endif

        <div class="row">
            @if ($posts->count())
            @foreach ($posts as $post)
            <div class="col-md-4">
                <div class="card mb-4">
                    <div class="card-header">
                        <div>
                            {{ $post->title }}
                        </div>
                    </div>

                    <div class="card-body">
                        <div>
                            {{ Str::limit($post->body, 25, '...') }}
                        </div>
                        <a href="/posts/{{$post->slug}}">Read More</a>
                    </div>

                    <div class="card-footer d-flex justify-content-between">
                        <div>
                            Published on {{ $post->created_at->format('d F, Y') }}

                            <a href="/posts/{{$post->slug}}/edit" class="btn btn-sm btn-secondary">Edit</a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach

            @else
                <div class="alert alert-warning">
                    Tidak ada post
                </div>
            @endif
        </div>
        <div class="d-flex justify-content-center">
            <div>
                {{$posts->links()}}
            </div>
        </div>
    </div>
@endsection