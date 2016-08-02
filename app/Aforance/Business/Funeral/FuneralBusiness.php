<?php 

namespace Aforance\Aforance\Business\Funeral;

use Aforance\Aforance\Business\Business;
use Aforance\Aforance\Contracts\Repository\FuneralPolicyRepositoryInterface;
use Aforance\Aforance\Policy\PolicyCreationListenerInterface;
use Aforance\Aforance\Repository\CustomerRepository;
use Aforance\Aforance\Support\DateHelper;
use Aforance\Aforance\Validation\ValidationException;

class FuneralBusiness extends Business{

	/**
	 * @var CustomerRepository
	 */
	private $customers;
	
	public function __construct(FuneralPolicyRepositoryInterface $repository){
		parent::__construct($repository);
		// Get a customer repository
		$this->customers = app('customer.repository');
		// Get a customer notification instance
		$this->notifier = app('customer.notifier');
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

		// Register policy issue validation handlers
		$this->setValidationHandlers(app('funeral.validation.handlers')['issue']);

		// Handle policy data validation against
		// registered handlers
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
		$data['policy_number'] = app('funeral.number_generator')->generate($this->policies->last());

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