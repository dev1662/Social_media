<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use App\Post;
use App\User;
// use App\likes;

class PostLikes extends Notification
{
    use Queueable;
    public $post;
    public $user;
    // public $likes;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Post $post, User $user)
    {
        //
        $this->post = $post;
        $this->user = $user;
        // $this->likes = $likes;
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
            'post' => $this->post,
            'user' => $this->user->name,
            // 'likes' => $this->likes
        ];
    }

    public function toBroadcast($notifiable)
    {
        return [
            'data' => [

                'post' => $this->post,
                'user' => $this->name,
              
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
