<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PaymentEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    protected $id, $amount;

    /**
     * Create a new event instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('channel-name'),
            'event' => 'payment',
            'payment_id' => $this->id,
            'payment_amount' => $this->amount
        ];
    }

    public function setPaymentId($id)
    {
        $this->id = $id;
    }

    public function setPaymentAmount($amount)
    {
        $this->amount = $amount;
    }
}
