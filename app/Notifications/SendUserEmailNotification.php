<?php

namespace App\Notifications;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SendUserEmailNotification extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */

    protected $messages;
    protected User $user;

    public function __construct($messages, $user)
    {
        $this->messages = $messages;
        $this->user = $user;

    } //-- end of constructor

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Notification from ' . setting('system_name'))
            ->greeting('Hello! ' . $this->user->username)
            ->line($this->messages)
            ->line('Thank you for using our application!');
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
            $this->messages
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
            'mail' => now()->addMinutes(1),
            'toDatabase' => now()->addMinutes(1),
        ];
    } //-- end withDelay()
}//-- end send user email notification
