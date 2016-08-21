<?php

namespace Aforance\Events;

use Aforance\Aforance\Contracts\Business\Policy;
use Aforance\Events\Event;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Money\Money;

class PremiumPaid extends Event
{
    use SerializesModels;

    /**
     * The policy on which the premium is paid
     *
     * @var Policy
     */
    public $policy;


    /**
     * The premium amount being paid
     *
     * @var Money
     */
    public $amount;


    /**
     * Create a new event instance.
     *
     * @param Policy $policy
     * @param Money $amount
     *
     * @return void
     */
    public function __construct(Policy $policy, Money $amount)
    {
        $this->policy = $policy;
        $this->amount = $amount;
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return [];
    }
}
