<?php
namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Support\Facades\Event;
use Illuminate\Broadcasting\BroadcastEvent;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class MessageSent extends Event implements ShouldBroadcast
{
    public $message;

    public function __construct($message)
    {
        $this->message = $message;
    }

    public function broadcastOn()
    {
        return new Channel('chat');
    }
}
