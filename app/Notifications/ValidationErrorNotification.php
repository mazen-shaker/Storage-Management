<?php

// app/Notifications/ValidationErrorNotification.php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\DatabaseMessage;

class ValidationErrorNotification extends Notification
{
    use Queueable;

    public $errors;

    /**
     * Create a new notification instance.
     *
     * @param  array  $errors
     * @return void
     */
    public function __construct(array $errors)
    {
        $this->errors = $errors;
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
            'errors' => $this->errors,
        ];
    }
}