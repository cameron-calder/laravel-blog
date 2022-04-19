<div class="post-feedback-actions" data-action-url="{{ route('post.feedback.update') }}">
    <div class="d-flex align-items-center post-feedback-buttons">
        <button class="btn btn-like ms-2 {{ $post->isUserLiked() ? 'btn-primary' : '' }}" 
            data-feedback-type="{{ $post->isUserLiked() ? 'none' : 'like' }}" 
            data-post-id="{{ $post->id }}">
            <i class="bi bi-hand-thumbs-up"></i>
            <span class="count" data-counted="{{ $post->isUserLiked() }}">
                {{ $post->like_feedback_count }}
            </span>
        </button>
        <button class="btn btn-dislike ms-2 {{ $post->isUserDisliked() ? 'btn-primary' : '' }}" 
            data-feedback-type="{{ $post->isUserDisliked() ? 'none' : 'dislike' }}" 
            data-post-id="{{ $post->id }}">
            <i class="bi bi-hand-thumbs-down"></i>
            <span class="count" data-counted="{{ $post->isUserDisliked() }}">
                {{ $post->dislike_feedback_count }}
            </span>
        </button>
    </div>
</div>