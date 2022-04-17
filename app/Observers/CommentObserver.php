<?php

namespace App\Observers;

use App\Models\Comment;
use App\Notifications\CommentPostedNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

class CommentObserver
{
    public function created(Comment $comment)
    {
        if (!$comment->post->isOwner()) {
            Notification::send($comment->post->user, new CommentPostedNotification($comment));
        }
    }
}
