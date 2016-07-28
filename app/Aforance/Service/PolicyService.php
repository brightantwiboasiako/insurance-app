<?php 

namespace Aforance\Aforance\Service;

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
	 * Makes a business based on the type
	 *
	 * @param $type
	 * @return PolicyIssuer
	 */
	private function makeBusiness($type){
		$business = null;
		switch($type){
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