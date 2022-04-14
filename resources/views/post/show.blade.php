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
        
                        <div class="d-flex align-items-center">
                            <button class="btn ms-2">
                                <i class="bi bi-hand-thumbs-up"></i>
                                0
                            </button>
                            <button class="btn ms-2">
                                <i class="bi bi-hand-thumbs-down"></i>
                                0
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 mt-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="card-title fw-bold">0 comments</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection