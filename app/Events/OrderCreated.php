<?php

namespace App\Events;

use App\DTO\OrderInformationDTO;
use App\Models\Order;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class OrderCreated
{
    use Dispatchable, SerializesModels;
    public $order;

    /**
     * Create a new event instance.
     */
    public function __construct(OrderInformationDTO $order)
    {
        $this->order = $order;
    }

}
