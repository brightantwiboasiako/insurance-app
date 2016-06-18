<?php 

namespace Aforance\Aforance\Customer;

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
	*
	* @var CustomerRepository
	*/
	private $customers;


	/**
	*
	* @var CustomerNotificationInterface 
	*/
	private $notifier;


	public function __construct(CustomerValidator $validator, CustomerNotificationInterface $notifier, Repository $customers){ 
		$this->validator = $validator;
		$this->notifier = $notifier;
		$this->customers = $customers;
	}


	public function handle($data){

		try{
			$this->validator->registrationValidation($data);
		}catch(ValidationException $e){
			throw $e;
		}

		// Customer data validated!

		$customer = $this->registerCustomer($data);

		$this->notifier->notify($customer, 'registration');
	}


	private function registerCustomer(array $data){
		return $this->customers->register($data);
	}


	public function errors(){
		return $this->validator->getErrors();
	}

}