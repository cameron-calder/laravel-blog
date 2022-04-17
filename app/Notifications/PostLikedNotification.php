<?php

namespace App\Notifications;

use App\Models\Feedback;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PostLikedNotification extends Notification
{  
    private Feedback $feedback;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Feedback $feedback)
    {
        $this->feedback = $feedback;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'message' => $this->message(),
            'url' => route('post.view', $this->feedback->post_id, false),
            'feedback_id' => $this->feedback->id,
            'post_id' => $this->feedback->post_id,
            'created_by' => $this->feedback->created_by,
        ];
    }

    public function message()
    {
        return strtr('Post #{post_id} was liked by {created_by_name}', [
            '{post_id}' => $this->feedback->post_id,
            '{created_by_name}' => $this->feedback->user->name,
        ]);
    }
}
