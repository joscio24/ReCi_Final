<?php

namespace App\Events;

use App\Models\Chat;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Queue\SerializesModels;

class MessageSent implements ShouldBroadcast
{
    use InteractsWithSockets, SerializesModels;

    public $message;

    public function __construct(Chat $message)
    {
        $this->message = $message;
    }

    public function broadcastOn()
    {
        // Public channel (no auth)
        return new Channel('chat.' . $this->message->id_debat);
    }

    public function broadcastWith()
    {
        return [
            'id_message' => $this->message->id_message,
            'texte' => $this->message->texte,
            'date_message' => $this->message->date_message,
            'user' => [
                'id' => $this->message->user->id,
                'name' => $this->message->user->name,
                // add profile_image if you want
            ],
        ];
    }

    public function broadcastAs()
    {
        return 'message.sent';
    }
}
