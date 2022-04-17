<?php

namespace App\Notifications;

use App\Models\Comment;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CommentPostedNotification extends Notification
{
    private Comment $comment;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Comment $comment)
    {
        $this->comment = $comment;
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
            'url' => route('post.view', $this->comment->post_id, false),
            'comment_id' => $this->comment->id,
            'post_id' => $this->comment->post_id,
            'created_by' => $this->comment->created_by,
        ];
    }
    
    public function message()
    {
        return strtr('Post #{post_id} commented on by {created_by_name}', [
            '{post_id}' => $this->comment->post_id,
            '{created_by_name}' => $this->comment->user->name,
        ]);
    }
}
