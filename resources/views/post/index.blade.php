@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="d-flex align-items-center justify-content-between">
            <h1>Posts</h1>

            <a href="{{ route('post.create') }}" class="btn btn-primary">
                Create
            </a>
        </div>

        <hr>

        <div class="row row-cols-1 row-cols-md-3 g-3 my-4">
            @foreach ($posts as $post)
                <div class="col">
                    <div class="card h-100">
                        <img src="{{ $post->thumbnailUrl() }}" class="card-img-top" alt="Image could not found">
                        <div class="card-body">
                            <h5 class="card-title fw-bold">{{ $post->title }}</h5>
                            <p class="card-text">{{ $post->content }}</p>
                            
                            <div class="text-muted mb-3">
                                <p class="m-0">
                                    Comments: {{ $post->comments_count }}
                                </p>
                                <p class="m-0">
                                    Created By: {{ $post->user->name ?? null }}
                                </p>
                                <p class="m-0" title="{{ $post->created_at->format('d/m/Y H:i') }}">
                                    Created: {{ $post->created_at->diffForHumans() }}
                                </p>
                            </div>

                            <div class="d-flex align-items-center">
                                <a href="{{ route('post.view', $post->id) }}" class="btn btn-primary">
                                    View
                                </a>

                                @if ($post->isOwner())
                                    <a href="{{ route('post.edit', $post->id) }}" class="btn btn-secondary ms-2">
                                        Edit
                                    </a>
                                @endif


                                <x-post-feedback-actions :post="$post"></x-post-feedback-actions>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="d-flex justify-content-center">
            {!! $posts->links() !!}
        </div>
    </div>

@endsection