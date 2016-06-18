<?php 

namespace Aforance\Aforance\Customer;

class RegistrationException extends \Exception{

	public function __construct(){
		parent::__construct('Customer could not be created at this time.');
	}

}