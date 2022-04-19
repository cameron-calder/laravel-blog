@extends('layouts.app')

@section('content')

    <div class="container">

        <div class="d-flex align-items-center justify-content-between">
            <h1>Post #{{ $post->id }}</h1>

                <div>
                    @if ($post->isOwner())
                        <a href="{{ route('post.edit', $post->id) }}" class="btn btn-secondary">
                            Edit
                        </a>
                    @endif
    
                    @if ($post->canDelete())
                        <form method="POST" action="{{ route('post.delete', $post->id) }}" class="d-inline" onSubmit="return confirm('You will be deleting this post. Proceed?');">
                            @csrf
        
                            <button type="submit" class="btn btn-danger">
                                Delete
                            </button>
                        </form>
                    @endif
                </div>
        </div>

        <hr>

        <div class="row justify-content-center my-4">
            <div class="col-12 col-md-4">
                <img src="{{ $post->thumbnailUrl() }}" class="card-img-top" alt="Image could not found">
            </div>
            <div class="col-12 col-md-8">
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
                        <h5 class="card-title fw-bold mb-4">{{ $post->comments_count }} comments</h5>
                        
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
                            @foreach ($comments as $comment)
                                <div class="col comment" data-id="{{ $comment->id }}">
                                    <div class="d-flex align-items-center">
                                        <span class="fw-bold">{{ $comment->user->name }}</span>
                                        <small class="text-muted ms-2" title="{{ $comment->created_at->format('d/m/Y H:i') }}">
                                            {{ $comment->created_at->diffForHumans() }}
                                        </small>

                                        <div class="d-flex ms-3">
                                            @if ($comment->isOwner())
                                                <a href="#" class="btn btn-sm btn-outline-primary btn-edit-comment me-1">
                                                    Edit
                                                </a>
                                            @endif

                                            @if ($comment->canDelete())
                                                <form method="POST" action="{{ route('comment.delete', $comment->id) }}" onSubmit="return confirm('You will be deleting this post. Proceed?');">
                                                    @csrf
    
                                                    <button type="submit" class="btn btn-sm btn-outline-danger">
                                                        Delete
                                                    </button>
                                                </form>
                                            @endif
                                        </div>

                                    </div>

                                    <p class="content">
                                        {{ $comment->content }}
                                    </p>
                                </div>
                            @endforeach

                            <div class="col-12">
                                {!! $comments->links() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="edit-comment-modal">
        <div class="modal-dialog">
            <form class="modal-content" method="POST" data-action="{{ route('comment.update', '') }}">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Comment</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @csrf

                    <div class="form-floating mb-3">
                        <textarea name="comment" class="form-control" placeholder="Edit comment here..." rows="6"></textarea>
                        <label for="floatingTextarea">Edit comment...</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Would've preferred to use Livewire
        $(document).ready(function () {
            var modal = $('#edit-comment-modal');

            $('.btn-edit-comment').click(function () {
                let comment = $(this).closest('.comment');
                let content = comment.find('.content');
                let form = modal.find('form');
                let action = form.data('action');
                    action += '/' + comment.data('id');
                let value = content.text().trim();
                
                modal.find('textarea').val(value);
                form.attr('action', action);
                modal.modal('show');
            });
        });
    </script>

@endsection