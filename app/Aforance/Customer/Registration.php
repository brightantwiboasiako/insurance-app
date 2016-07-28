<?php 

namespace Aforance\Aforance\Customer;

use Aforance\Aforance\Customer\Contracts\CustomerRegistrationListenerInterface;
use Aforance\Aforance\Validation\CustomerValidator;
use Aforance\Aforance\Validation\ValidationException;
use Aforance\Aforance\Notification\Contracts\CustomerNotificationInterface;
use Aforance\Aforance\Repository\CustomerRepository as Repository;

class Registration{

	/**
	* Validator for customer actions
	*
	* @var CustomerValidator
	*/
	private $validator;



	/**
	* The repository of customers
	* @var Repository
	*/
	private $customers;


	/**
	* Notifier for customer notifications
	* @var CustomerNotificationInterface 
	*/
	private $notifier;


	public function __construct(CustomerValidator $validator, CustomerNotificationInterface $notifier, Repository $customers){ 
		$this->validator = $validator;
		$this->notifier = $notifier;
		$this->customers = $customers;
	}


	public function handle($data, CustomerRegistrationListenerInterface $listener){

		try{
			$this->validator->registrationValidation($data);
		}catch(ValidationException $e){
			return $listener->onFailedRegistration([
				'reason' => 'validation',
				'errors' => $this->validator->getErrors()
			]);
		}

		$customer = $this->customers->register($data);

		$this->notifier->notify([
			'customer' => $customer
		], 'registration');

		return $listener->onSuccessfulRegistration();
	}

}