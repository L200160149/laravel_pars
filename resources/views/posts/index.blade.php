@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h4>Posts</h4>
               
                @foreach ($posts as $post)
                <div class="col-md-6">
                    <div class="card mb-2">
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

                        <div class="card-footer">
                            <div>
                                Published on {{ $post->created_at->format('d F, Y') }}
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach

                {{$posts->links()}}
            </div>
        </div>
    </div>
@endsection