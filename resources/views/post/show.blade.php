@extends('layouts.app')

@section('content')

    <div class="container">

        <div class="d-flex align-items-center justify-content-between">
            <h1>Post #{{ $post->id }}</h1>

            @if ($post->isOwner())
                <div>
                    <a href="{{ route('post.edit', $post->id) }}" class="btn btn-secondary">
                        Edit
                    </a>
    
                    <form method="POST" action="{{ route('post.delete', $post->id) }}" class="d-inline">
                        @csrf
    
                        <button type="submit" class="btn btn-danger">
                            Delete
                        </button>
                    </form>
                </div>
            @endif
        </div>

        <hr>

        <div class="row row-cols-2 justify-content-center my-4">
            <div class="col col-md-4">
                <img src="{{ $post->thumbnailUrl() }}" class="card-img-top" alt="Image could not found">
            </div>
            <div class="col col-md-8">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="card-title fw-bold">{{ $post->title }}</h5>
                        <p class="card-text">{{ $post->content }}</p>
                        
                        <div class="text-muted mb-3">
                            <p class="m-0">
                                Created By: {{ $post->user->name ?? null }}
                            </p>
                            <p class="m-0" title="{{ $post->created_at->format('d/m/Y H:i') }}">
                                Created: {{ $post->created_at->diffForHumans() }}
                            </p>
                        </div>

                        <x-post-feedback-actions :post="$post"></x-post-feedback-actions>
                    </div>
                </div>
            </div>
            <div class="col-12 mt-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="card-title fw-bold mb-4">{{ count($post->comments) }} comments</h5>
                        
                        <form class="mb-4" id="post-comment-form" method="POST" action="{{ route('post.comment.submit', $post->id) }}">
                            @csrf

                            <div class="form-floating mb-3">
                                <textarea name="comment" class="form-control" placeholder="Leave a comment here" rows="3"></textarea>
                                <label for="floatingTextarea">Add a comment...</label>
                            </div>

                            <div class="text-end">
                                <button type="reset" class="btn btn-outline-secondary">Cancel</button>
                                <button type="submit" class="btn btn-primary">Comment</button>
                            </div>
                        </form>

                        <div class="row row-cols-1">
                            @foreach ($post->comments as $comment)
                                <div class="col comment" data-id="{{ $comment->id }}">
                                    <div>
                                        <span class="fw-bold">{{ $comment->user->name }}</span>
                                        <span class="text-muted ms-1" title="{{ $comment->created_at->format('d/m/Y H:i') }}">
                                            {{ $comment->created_at->diffForHumans() }}
                                        </span>
                                        @if ($comment->isOwner())
                                            <a href="#" class="btn btn-sm btn-outline-primary ms-2">
                                                Edit
                                            </a>
                                            <a href="#" class="btn btn-sm btn-outline-danger ms-1">
                                                Delete
                                            </a>
                                        @endif
                                    </div>

                                    <p>
                                        {{ $comment->content }}
                                    </p>

                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- <script>
        $(document).ready()
    </script> --}}

@endsection