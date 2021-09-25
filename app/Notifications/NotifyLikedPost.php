<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use App\Post;
use App\Comments;
use App\User;

class NotifyLikedPost extends Notification
{
    use Queueable;

    public $post;
     public $user;
     public $comment;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Post $post, User $user, Comments $comment)
    {
        //
        $this->post = $post;
        $this->user = $user;
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
        return ['database', 'broadcast'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toDatabase($notifiable)
    {
        return [
            'post'=> $this->post,
            'user'=> $this->user->name,
            // 'comment' => $this->comment
            'comment' => $this->comment->id
        ];
    }

    public function toBroadcast($notifiable)
    {
        return [
            'data' => [

                'post'=> $this->post,
                'user'=> $this->user,
                'comment' => $this->comment,
                // 'comment' => $this->comment
                
            ]
        ];
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
            //
            'user'=> $this->user,
            'name'=> $this->user->name,
        ];
    }
}
