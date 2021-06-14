@extends('layouts.app', ['title' => 'New Post'])

@section('content')

    <div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">New Post</div>
                <div class="card-body">
                    <form action="/posts/store" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <input type="file" name="thumbnail" id="thumbnail">
                            @error('thumbnail')
                                <div class="text-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" name="title" value="{{ old('title') }}" class="form-control @error('title') is-invalid @enderror">
                            @error('title')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                    {{-- atau --}}
                                    {{-- Title harus diisi --}}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="category">Category</label>
                            <select name="category" id="category" class="form-control select2search">
                                <option disabled selected>-- Pilih Kategori --</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                            @error('category')
                                <div class="text-danger mt-2">
                                    {{ $message }}
                                    {{-- atau --}}
                                    {{-- Title harus diisi --}}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="tags">Tag</label>
                            <select name="tags[]" id="tags" class="form-control select2" multiple>
                                {{-- <option disabled selected>-- Pilih Tags --</option> --}}
                                @foreach ($tags as $tag)
                                    <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                                @endforeach
                            </select>
                            @error('tags')
                                <div class="text-danger mt-2">
                                    {{ $message }}
                                    {{-- atau --}}
                                    {{-- Title harus diisi --}}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="body">Description</label>
                            <textarea name="body" id="body" class="form-control">{{ old('body') }}</textarea>
                            @error('body')
                                <div class="text-danger mt-2">
                                    Body harus diisi.
                                </div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Create</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection