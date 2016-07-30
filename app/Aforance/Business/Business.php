<?php 

namespace Aforance\Aforance\Business;

use Aforance\Aforance\Contracts\Business\DocumentRenderer;
use Aforance\Aforance\Contracts\Business\Policy;
use Aforance\Aforance\Contracts\Business\PolicyIssuer;
use Aforance\Aforance\Notification\Contracts\CustomerNotificationInterface;
use Aforance\Aforance\Policy\PolicyCreationListenerInterface;
use Aforance\Aforance\Service\PremiumService;
use Aforance\Aforance\Validation\DispatchesErrors;
use Aforance\Aforance\Validation\ValidationException;
use Aforance\Aforance\Validation\PolicyValidatorInterface;
use Aforance\Aforance\Repository\Contracts\PolicyRepositoryInterface;

abstract class Business  implements PolicyIssuer, DocumentRenderer{

	use DispatchesErrors;

	/**
	*
	* @var PolicyValidatorInterface
	*/
	protected $validator;


	/**
	*
	* @var PremiumService
	*/
	protected $premiumService;	


	/**
	*
	* @var PolicyRepositoryInterface
	*/
	protected $policies;


	/**
	*
	* @var CustomerNotificationInterface
	*/
	protected $notifier;


	public function __construct(PolicyValidatorInterface $validator, PolicyRepositoryInterface $policies){
		$this->validator = $validator;
		$this->policies = $policies;
		$this->premiumService = app('premium');
	}


	/**
	* Issues a new policy
	*
	* @param array $data
	* @return Policy
	*
	*/
	public function createPolicy(array $data){

		// create policy
		$policy = $this->policies->create($data);

		// notify customer of policy creation
		$this->notifier->notify($data, 'policy creation');

		return $policy;
	}


	/**
	* Validates policy data
	*
	* @param array $data
	*
	* @return null
	*
	* @throws ValidationException
	*/
	public function validate(array $data){
		try{
			$this->validator->checkPolicyData($data);
		}catch(ValidationException $e){
			throw $e;
		}
	}

}