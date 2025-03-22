<?php
namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;


class MessageBroadcasted implements ShouldBroadcast
{
    use InteractsWithSockets, SerializesModels, Dispatchable;

    public $state;
    public $message;

    public function __construct($state, $message)
    {
        $this->state = $state;
        $this->message = $message;
    }

    // Broadcast on a private channel
    public function broadcastOn()
    {
        return new PrivateChannel('messages.' . auth()->id());
    }

    public function broadcastAs()
    {
        return 'message.broadcasted'; // Event name
    }
}