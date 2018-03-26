<?php

namespace App\Events;

use App\Models\Work;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class WorkCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $work;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Work $work)
    {
        $this->work = $work;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
