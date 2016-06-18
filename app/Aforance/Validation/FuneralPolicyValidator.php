<?php 

namespace Aforance\Aforance\Business\Funeral;

use Aforance\Aforance\Validation\Validator;
use Aforance\Aforance\Validation\PolicyValidatorInterface;

class FuneralPolicyValidator extends Validator implements PolicyValidatorInterface{


	/**
	* @throws ValidationException
	*/
	public function checkPolicyData(array $data){

		$this->validate($data, $this->getPolicyRules());

		foreach($data['family'] as $family){
			$this->validate($family, $this->getFamilyMemberRules());
		}
	}


	private function getFamilyMemberRules(){
		return [

		];
	}


	private function getPolicyRules(){
		return [
			'sum_assured' => 'required|numeric|min:0',
			'issue_date' => 'required|date|max:today',
			'automatic_update' => 'required|numeric|min:0',
			'bank_name' => 'max:64',
			'account_number' => 'max:32',
			'mode_of_payment' => 'required',
			'payment_frequency' => 'required',
			'accident_rider' => 'required'
		];
	}


}