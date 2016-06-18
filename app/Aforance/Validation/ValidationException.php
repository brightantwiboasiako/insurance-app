<?php 

namespace Aforance\Aforance\Validation;

class ValidationException extends \Exception{

	public function __construct(){
		parent::__construct('Validation was unsuccessful.');
	}

}