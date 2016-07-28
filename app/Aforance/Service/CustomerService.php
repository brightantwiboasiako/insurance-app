<?php 

namespace Aforance\Aforance\Service;

use Aforance\Aforance\Customer\Contracts\CustomerRegistrationListenerInterface;
use Aforance\Aforance\Customer\Registration;
use Aforance\Aforance\Service\Contracts\ServiceInterface;
use Aforance\Aforance\Support\Contracts\Checker;
use Aforance\Aforance\Support\Permission\CanCheckPermission;


class CustomerService implements ServiceInterface{

	use CanCheckPermission;

	/**
	* Registration instance
	*
	* @var Registration
	*/
	private $registration;


	/**
	 * The permission checker of this service
	 *
	 * @var Checker
	 */
	private $checker;

	public function __construct(Checker $checker){
		$this->checker = $checker;
		$this->checker->service('customer');
	}


	/**
	 * Handles the creation of a new customer
	 * 
	 * @param array $data
	 * @param CustomerRegistrationListenerInterface $listener
	 * @return mixed
	 */
	public function createCustomer(array $data, $role, CustomerRegistrationListenerInterface $listener){

		if($this->isPermittedTo('create', $role)){
			// not injecting because, registration is done once
			// and injecting a registration object all the time
			// is a little wrong!
			$this->registration = app('Aforance\Aforance\Customer\Registration');
			return $this->registration->handle($data, $listener);
		}else{
			return $this->failedCheck($listener);
		}

	}


	/**
	 * Handles a failed permission check
	 *
	 * @param CustomerRegistrationListenerInterface $listener
	 * @return mixed
	 */
	private function failedCheck(CustomerRegistrationListenerInterface $listener){
		return $listener->onFailedRegistration([
			'reason' => 'permission'
 		]);
	}

}