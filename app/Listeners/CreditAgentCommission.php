<?php

namespace Aforance\Listeners;

use Aforance\Aforance\Service\AgencyService;
use Aforance\Events\PremiumPaid;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class CreditAgentCommission
{

    /**
     * The agency service instance
     *
     * @var AgencyService
     */
    private $agency;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        $this->agency = app('agency');
    }

    /**
     * Handle the event.
     *
     * @param  PremiumPaid  $event
     * @return void
     */
    public function handle(PremiumPaid $event)
    {

    }
}
