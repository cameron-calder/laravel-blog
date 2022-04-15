@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="d-flex align-items-center justify-content-between">
            <h1>
                @if ($post->exists) 
                    Edit Post #{{ $post->id }}
                @else
                    Create Post
                @endif
            </h1>
        </div>

        <hr>

        <x-errors />

        <div class="row my-4">
            <div class="col">
                <div class="card h-100">
                    <div class="card-body">
                        <form method="POST" 
                            action="{{ $post->exists ? route('post.edit.submit', $post->id) : route('post.create.submit') }}"
                            enctype="multipart/form-data">
                            @csrf

                            <div class="mb-3">
                                <label class="form-label">Title</label>
                                <input type="text" name="title" class="form-control" value="{{ old('title', $post->title) }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Content</label>
                                <textarea class="form-control" name="content">{{ old('content', $post->content) }}</textarea>
                            </div>
                            <div class="mb-4">
                                <label class="form-label">Thumbnail</label>
                                <input type="file" name="thumbnail" class="form-control">
                            </div>

                            <button type="submit" class="btn btn-primary">
                                {{ $post->exists ? 'Update' : 'Create' }}
                            </button>
                            <a href="{{ $post->exists ? route('post.view', $post->id) : route('posts') }}" class="btn btn-secondary">
                                Cancel
                            </a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection