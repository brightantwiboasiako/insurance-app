<?php 

namespace Aforance\Aforance\Business;

use Aforance\Aforance\Validation\ValidationException;

class FuneralBusiness extends Business{

	public function __construct(FuneralPolicyValidator $validator, FuneralPolicyRepository $repository){
		parent::__construct($validator, $repository);

		$this->type = 'funeral';
	}


	/**
	* Handles the issuing of a funeral policy
	*
	* @param array $data
	*
	* @return null
	* 
	* @throws ValidationException
	*/
	public function issue(array $data){
		// validate policy data
		parent::validate($data);

		// get first premium
		$data['premium'] = $this->premiumService->getFirstPremium('funeral', $data);

		// complete the policy issue
		parent::issue($data);
	}

}