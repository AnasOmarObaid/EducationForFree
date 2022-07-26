<?php

namespace App\Notifications;

use App\Models\Post;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SendPostNotification extends Notification implements ShouldQueue
{
    use Queueable;

    //protected $messages;
    protected Post $post;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($post)
    {
        $this->post = $post;
        //$this->messages = 'post from  ' . $this->post->author->username . 'is published: ' . $this->post->title;
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
    public function toDatabase($notifiable)
    {
        return [
            'theirs new post from ' . $this->post->author->username . ' is published: ' . route('admins.posts.index')
        ];
    }

    /**
     * Determine the notification's delivery delay.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function withDelay($notifiable)
    {
        return [
            'toDatabase' => now()->addMinutes(1),
        ];
    } //-- end withDelay()
}//-- end notification
