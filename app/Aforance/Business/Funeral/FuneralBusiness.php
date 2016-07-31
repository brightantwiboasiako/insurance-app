<?php 

namespace Aforance\Aforance\Business\Funeral;

use Aforance\Aforance\Business\Business;
use Aforance\Aforance\Contracts\Repository\FuneralPolicyRepositoryInterface;
use Aforance\Aforance\Contracts\Validation\FuneralValidatorInterface;
use Aforance\Aforance\Policy\PolicyCreationListenerInterface;
use Aforance\Aforance\Repository\CustomerRepository;
use Aforance\Aforance\Support\DateHelper;
use Aforance\Aforance\Validation\CanCheckPolicyData;
use Aforance\Aforance\Validation\PolicyValidatorInterface;
use Aforance\Aforance\Validation\ValidationException;

class FuneralBusiness extends Business{

	use CanCheckPolicyData;

	/**
	 * @var CustomerRepository
	 */
	private $customers;
	
	public function __construct(PolicyValidatorInterface $validator, FuneralPolicyRepositoryInterface $repository){
		parent::__construct($validator, $repository);
		$this->customers = app('customer.repository');
		$this->notifier = app('customer.notifier');
	}


	public static function last(){
		return static::orderBy('id', 'DESC')->first();
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

		// handle policy data validation
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

		// set policy number
		$data['policy_number'] = app('funeral.number_generator').generate($this->policies->last());

		// complete the policy issue
		$policy = parent::createPolicy($data);

		return $listener->onSuccessfulCreation([
			'number' => $policy->policyNumber()
		]);
	}


	public function renderDocument($policyNumber, $action)
	{
		$document = app('funeral.document');
		return $document->handle($policyNumber, $action);
	}

}