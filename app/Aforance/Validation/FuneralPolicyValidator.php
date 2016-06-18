<?php 

namespace Aforance\Aforance\Business\Funeral;

use Aforance\Aforance\Validation\Validator;
use Aforance\Aforance\Validation\PolicyValidatorInterface;

class FuneralPolicyValidator extends Validator implements PolicyValidatorInterface{


	/**
	* @throws ValidationException
	*/
	public function checkPolicyData(array $data){

		$rules = [];

		$this->validate($data, $rules);
	}

}