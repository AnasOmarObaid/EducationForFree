<?php

namespace App\Notifications;

use App\Models\EducBit;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SendEducBitNotification extends Notification implements ShouldQueue
{
    use Queueable;


    private EducBit $bit;
    private $messages;
    /**
     * Create a new notification instance.
     *
     * @return void
     */

    public function __construct($messages, EducBit $bit)
    {
        $this->messages = $messages;
        $this->bit = $bit;
    } //-- end __construct

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database', 'mail'];
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
            ->greeting('Hello!')
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
            $this->messages,
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
            'database' => now()->addMinutes(1),
        ];
    }
}
