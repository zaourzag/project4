<?php
namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ImageUploaded implements ShouldBroadcastNow
{
    use InteractsWithSockets, SerializesModels, Dispatchable;

    public $imageUrl;

    public function __construct($imageUrl)
    {
        $this->imageUrl = $imageUrl;
    }

    public function broadcastOn()
    {
        return new Channel('image-uploads'); // Public channel
    }

    public function broadcastAs()
    {
        return 'image.uploaded'; // Event name
    }
}