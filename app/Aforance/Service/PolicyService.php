<?php 

namespace Aforance\Aforance\Service;

use Aforance\Aforance\Business\Business;
use Aforance\Aforance\Policy\PolicyActionListenerInterface;
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

	/**
	 * PolicyService constructor.
	 */
	public function __construct()
	{
		$this->checker = app('permission.checker');
		$this->checker->service('policy');
	}


	/**
	 * Gets a policy by it's number for viewing.
	 * It checks first if the role/user is permitted
	 * to view policies before proceeding.
	 *
	 * @param $business
	 * @param $policyNumber
	 * @param $role
	 * @param PolicyActionListenerInterface $listener
	 * @return mixed
	 */
	public function getPolicyByNumber($business, $policyNumber, $role, PolicyActionListenerInterface $listener){
		if($this->isPermittedTo('view', $role)){
			$business = $this->makeBusiness($business);
			$policy = $business->getPolicyByNumber($policyNumber);

			if($policy)
				return $listener->onSuccessfulAction($listener->getAction(),
						['policy' => $business->getPolicyByNumber($policyNumber)]);
			else
				return $listener->onFailedAction($listener->getAction(), ['reason' => 'not found']);
		}else{
			return $listener->onFailedAction($listener->getAction(), ['reason' => 'permission']);
		}
	}


	/**
	 * Public interface for getting a business
	 * instance based on the type
	 *
	 * @param $type
	 * @return Business
	 */
	public function business($type){
		return $this->makeBusiness($type);
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
			return $listener->onFailedCreation(['reason' => 'permission']);
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
		return app('business.'.preg_replace('/\s+/','',$type));
	}


}