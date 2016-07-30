<?php 

namespace Aforance\Aforance\Validation;

interface PolicyValidatorInterface extends ValidationInterface{

	public function checkPolicyData(array $data);
	public function errors();
	
}