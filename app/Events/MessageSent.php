<?php

namespace App\Events;

use App\Models\Chat;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Queue\SerializesModels;

class MessageSent implements ShouldBroadcastNow
{
    use InteractsWithSockets, SerializesModels;

    public $message;

    public function __construct(Chat $message)
    {
        $this->message = $message;
    }

    public function broadcastOn()
    {
        \Log::info("Broadcasting on channel: chat.{$this->message->id_debat}");

        return new Channel('chat.' . $this->message->id_debat);

    }


    public function broadcastWith()
    {


        return [
            'id' => $this->message->id,
            'user' => $this->message->user->name,
            'message' => $this->message->message,
            'time' => $this->message->created_at->format('H:i:s'),
            'user_id' => $this->message->user->id, // Add user_id
            'created_at' => $this->message->created_at, // Add created_at
        ];
    }
}
