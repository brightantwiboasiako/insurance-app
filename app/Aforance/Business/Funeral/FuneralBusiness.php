<?php 

namespace Aforance\Aforance\Business\Funeral;

use Aforance\Aforance\Business\Business;
use Aforance\Aforance\Contracts\Business\PolicyIssuer;
use Aforance\Aforance\Contracts\Validation\FuneralValidatorInterface;
use Aforance\Aforance\Contracts\Repository\FuneralPolicyRepositoryInterface;
use Aforance\Aforance\Policy\PolicyCreationListenerInterface;
use Aforance\Aforance\Repository\CustomerRepository;
use Aforance\Aforance\Support\DateHelper;
use Aforance\Aforance\Validation\ValidationException;

class FuneralBusiness extends Business implements PolicyIssuer{

	/**
	 * @var CustomerRepository
	 */
	private $customers;
	
	public function __construct(FuneralValidatorInterface $validator, FuneralPolicyRepositoryInterface $repository){
		parent::__construct($validator, $repository);
		$this->type = 'funeral';
		$this->customers = app('customer.repository');
	}


	/**
	* Handles the issuing of a funeral policy
	*
	* @param array $data
	* @param PolicyCreationListenerInterface $listener
	* @return null
	* 
	* @throws ValidationException
	*/
	public function issue(array $data, PolicyCreationListenerInterface $listener){
		try{
			// validate policy data
			parent::validate($data);
		}catch(ValidationException $e){
			return $listener->onFailedCreation([
				'reason' => 'validation',
				'errors' => $this->validator->errors()
			]);
		}

		// get customer's age
		$data['age'] = DateHelper::ageNextBirthday($this->customers->find($data['customer_id'])->birthday());

		// get first premium
		$data['premium'] = $this->premiumService->getFirstPremium('funeral', $data);
		// complete the policy issue
		parent::createPolicy($data);
		return $listener->onSuccessfulCreation();
	}

}