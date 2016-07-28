<?php 

namespace Aforance\Aforance\Business;

use Aforance\Aforance\Notification\Contracts\CustomerNotificationInterface;
use Aforance\Aforance\Policy\PolicyCreationListenerInterface;
use Aforance\Aforance\Service\PremiumService;
use Aforance\Aforance\Validation\DispatchesErrors;
use Aforance\Aforance\Validation\ValidationException;
use Aforance\Aforance\Validation\PolicyValidatorInterface;
use Aforance\Aforance\Repository\Contracts\PolicyRepositoryInterface;

abstract class Business{

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
	* @var string
	*/
	protected $type;


	/**
	*
	* @var CustomerNotificationInterface
	*/
	private $notifier;


	public function __construct(PolicyValidatorInterface $validator, PolicyRepositoryInterface $policyRepository){
		$this->validator = $validator;
		$this->policies = $policyRepository;
		$this->premiumService = app('premium');
		$this->notifier = app('customer.notifier');
	}


	/**
	* Issues a new policy
	*
	* @param array $data
	* @return null
	*
	*/
	public function createPolicy(array $data){
		// create policy
		$this->policies->create($data);

		// notify customer of policy creation
		$this->notifier->notify($data, 'policy creation');
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