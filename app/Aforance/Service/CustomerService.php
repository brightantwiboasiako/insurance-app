<?php 

namespace Aforance\Aforance\Service;

use Aforance\Aforance\Customer\Registration;
use Aforance\Aforance\Validation\DispatchesErrors;
use Aforance\Aforance\Validation\ValidationException;
use Aforance\Aforance\Customer\RegistrationException;
use Aforance\Aforance\Service\Contracts\ServiceInterface;


class CustomerService implements ServiceInterface{

	use DispatchesErrors;

	/**
	* Registration instance
	*
	* @var Registration
	*/
	private $registration;


	public function __construct(){

	}


	public function createCustomer(array $data){

		try {
			// not injecting because, registration is done once
			// and injecting a registration object all the time
			// is a little wrong!
			$this->registration = app('Aforance\Aforance\Customer\Registration');
			$this->registration->handle($data);
		} catch (ValidationException $e) {

			$this->addAllToBag($this->registration->errors());

			throw $e;
		}

	}


}