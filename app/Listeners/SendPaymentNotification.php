<?php

namespace Aforance\Listeners;

use Aforance\Events\PremiumPaid;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendPaymentNotification
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  PremiumPaid  $event
     * @return void
     */
    public function handle(PremiumPaid $event)
    {
        //
    }
}
