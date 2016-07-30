<?php 

namespace Aforance\Aforance\Service;

use Aforance\Aforance\Business\Business;
use Aforance\Aforance\Contracts\Business\PolicyIssuer;
use Aforance\Aforance\Policy\PolicyCreationListenerInterface;
use Aforance\Aforance\Service\Contracts\ServiceInterface;
use Aforance\Aforance\Support\Contracts\Checker;
use Aforance\Aforance\Support\Permission\CanCheckPermission;

class PolicyService implements ServiceInterface{

	use CanCheckPermission;


	/**
	 * @var Checker
	 */
	private $checker;

	public function __construct(Checker $checker)
	{
		$this->checker = $checker;
		$this->checker->service('policy');
	}

	/**
	 * Handles the issuance of a policy
	 *
	 * @param array $data
	 * @param $role
	 * @param PolicyCreationListenerInterface $listener
	 * @return mixed|null
	 */
	public function issuePolicy(array $data, $role, PolicyCreationListenerInterface $listener){
		if($this->isPermittedTo('create', $role)){
			return $this->makeBusiness($data['business_type'])->issue($data, $listener);
		}else{
			return $this->failedCheck($listener);
		}
	}


	/**
	 * Generates a policy document
	 * 
	 * @param $business
	 * @param $policyNumber
	 * @param string $action
	 * @return mixed
	 */
	public function policyDocument($business, $policyNumber, $action){
		return $this->makeBusiness($business)->renderDocument($policyNumber, $action);
	}
	

	/**
	 * Makes a business based on the type
	 *
	 * @param $type
	 * @return Business
	 */
	private function makeBusiness($type){
		$business = null;
		switch($type){
			case 'loan protection':
				$business = app('business.loanprotection');
				break;
			default:
				$business = app('business.funeral');
		}
		return $business;
	}


	/**
	 * Handles a denied permission
	 *
	 * @param PolicyCreationListenerInterface $listener
	 * @return mixed
	 */
	private function failedCheck(PolicyCreationListenerInterface $listener){
		return $listener->onFailedCreation(['reason' => 'permission']);
	}

}