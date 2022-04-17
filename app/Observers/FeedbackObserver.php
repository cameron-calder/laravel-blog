<?php

namespace App\Observers;

use App\Models\Feedback;
use Illuminate\Support\Facades\Notification;
use App\Models\PostFeedback;
use App\Notifications\PostLikedNotification;
use Illuminate\Support\Facades\Auth;

class FeedbackObserver
{
    public function created(Feedback $feedback)
    {   
        if (!$feedback->post->isOwner() && $feedback->type == 'like') {
            Notification::send($feedback->post->user, new PostLikedNotification($feedback));
        }
    }
}
