<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Notifications\Notification;

class NewMessageNotification extends Notification
{
    use Queueable;
  public $message;
    public $state;
    public function __construct($message, $state = 'success')
    {
        $this->message = $message;
        $this->state = $state;
    }
    public function via($notifiable)
    {
        return ['broadcast'];
    }

    public function toBroadcast($notifiable)
    {
        return [
            'message' => $this->message,
            'state' => $this->state,
        ];
    }
    public function toArray($notifiable)
    {
        return new BroadcastMessage([
            'message' => $this->message,
            'state' => $this->state,
        ]);
    }
}