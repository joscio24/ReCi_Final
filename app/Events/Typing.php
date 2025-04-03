<?php

// Typing.php (Event)

namespace App\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;

class Typing implements ShouldBroadcastNow
{
    use InteractsWithSockets, SerializesModels;

    public $user_id;
    public $user_name;
    public $postCardId;

    public function __construct($postCardId, $userId, $user_name)
    {
        $this->postCardId = $postCardId;
        $this->user_id = $userId;
        $this->user_name = $user_name;
    }

    // Specify which channel the event will broadcast on
    public function broadcastOn()
    {
        \Log::info("Broadcasting on channel: chatType.{$this->postCardId}");

        return new Channel('chatType.' . $this->postCardId);
    }

    // Specify the event name to listen for

    public function broadcastWith()
    {


        return [
            'postCardId' => $this->postCardId,
            'user_id' => $this->user_id,
            'user_name' => $this->user_name
        ];
    }
}
