<?php 

namespace Aforance\Aforance\Service;

use Aforance\Aforance\Notification\Contracts\CustomerNotificationInterface;
use Aforance\Aforance\Repository\ClaimRepository;

/**
* 
*/
class ClaimService
{
	private $claim;
	private $notifier;

	public function __construct( ClaimRepository $claim, CustomerNotificationInterface $notifier)
	{
		$this->claim = $claim;
		$this->notifier = $notifier;
	}

	public function register($data)
	{							
		return $this->claim->register($data);

		//notification service
		//verification service
	}

	public function payment()
	{
		return $this->claim->payClaim();

		//notification
	}

	public function view()
	{
		return $this->claim->viewClaim();

	}

	public function customers($data)
	{
		return $this->claim->clients($data);
	}

	public function update($data)
	{
		$this->claim->updateClaim($data);
	}

	public function policies($data)
	{
		return $this->claim->policies($data);
	}


	

}