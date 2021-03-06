@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between">
            <div>
                @isset ($category)
                    <h4>Category : {{ $category->name }}</h4>
                @endisset
                
                @isset($tag)
                    <h4>Tags : {{ $tag->name }}</h4>
                @endisset

                @if (!isset($category) && !isset($tag))
                    <h4>All Posts</h4>
                @endif
                <hr>
            </div>
            <div>
                @if(Auth::check()   )
                    <a href="/posts/create" class="btn btn-primary">New Post</a>
                @endif
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

                    <img class="card-img-top" src="{{ asset("storage/" . $post->thumbnail) }}" alt="">
                    <div class="card-body">
                        <div>
                            {{ Str::limit($post->body, 25, '...') }}
                        </div>
                        <a href="/posts/{{$post->slug}}">Read More</a>
                    </div>

                    <div class="card-footer d-flex justify-content-between">
                        <div>
                            Published on {{ $post->created_at->format('d F, Y') }}
                            <br>
                            Author : {{ $post->author->username }}
                            
                            {{-- cara 1 membatasi hak akses --}}
                            {{-- @if(auth()->user()->id == $post->user_id) --}}
                            {{-- cara 2 membatasi hak akses --}}
                            {{-- @if(auth()->user()->is($post->author)) --}}
                            {{-- cara 3 menggunakan policy --}}
                            @can('update', $post)
                                <a href="/posts/{{$post->slug}}/edit" class="btn btn-sm btn-secondary">Edit</a>
                                
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#exampleModal">
                                    Delete
                                </button>
                            @endcan
                            
                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Hapus data ?</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>
                                    <form action="/posts/{{$post->slug}}/delete" method="post">
                                    <div class="modal-body">
                                            @csrf
                                            @method('delete')
                                            Hapus Data ?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Tidak</button>
                                            <button type="submit" class="btn btn-sm btn-danger">Ya</button>
                                        </div>
                                    </form>
                                </div>
                                </div>
                            </div>
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