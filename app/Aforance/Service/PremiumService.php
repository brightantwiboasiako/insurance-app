<?php 

namespace Aforance\Aforance\Service;

use Aforance\Aforance\Contracts\Business\Policy;
use Aforance\Aforance\Policy\PolicyActionListenerInterface;
use Aforance\Aforance\Premium\FatalVerificationException;
use Aforance\Aforance\Premium\PremiumRepository;
use Aforance\Aforance\Service\Contracts\ServiceInterface;
use Aforance\Aforance\Premium\Calculators\PremiumCalculatorInterface;
use Aforance\Aforance\Support\Contracts\Checker;
use Aforance\Aforance\Support\Permission\CanCheckPermission;
use Aforance\Aforance\Validation\ValidationException;
use Aforance\Aforance\Validation\Validator;

class PremiumService implements ServiceInterface{

	use CanCheckPermission;

	/**
	 * Permissions checker instance
	 *
	 * @var Checker
	 */
	private $checker;

	/**
	 * PolicyService instance
	 *
	 * @var PolicyService
	 */
	private $policyService;


	/**
	 * Validator instance
	 * 
	 * @var Validator
	 */
	private $validator;

	/**
	 * Repository of premiums
	 *
	 * @var PremiumRepository
	 */
	private $premiums;


	public function __construct()
	{
		$this->checker = app('permission.checker');
		// Set service namespace of the permission checker.
		$this->checker->service('premium');

		// Set the policy service
		$this->policyService = app('policy');

		// Set premium repository
		$this->premiums = app('premium.repository');
	}


	public function payPremium(array $data, $policyNumber, $role, PolicyActionListenerInterface $listener){
		// check if role is permitted to pay premium
		if($this->isPermittedTo('pay', $role)){

			try{
				// Check premium data
				$this->checkPremiumData($data);

				// Bind necessary data
				

				// Verify premium data
				$verifiers = app('premium.verifiers');
				foreach($verifiers as $verifier){
					$verifier->verify($data);
				}

			}catch(ValidationException $e){ // validation failed
				return $listener->onFailedAction($listener->getAction(), [
					'reason' => 'validation',
					'errors' => $this->validator->errors()
				]);
			}catch(FatalVerificationException $e){ // fatal verification failed
				return $listener->onFailedAction($listener->getAction(), [
					'reason' => 'fatal',
					'message' => $e->getMessage()
				]);
			}


			// Save premium data to repository
			$this->premiums->create($data);

			// TODO: Notify client about premium payment

		}else{
			return $listener->onFailedAction($listener->getAction(), [
				'reason' => 'permission'
			]);
		}

	}


	/**
	 * Checks premium data for validity
	 *
	 * @param array $data
	 * @throws ValidationException
	 */
	public function checkPremiumData(array $data){

		// Set handlers
		$this->validator->setHandlers(app('premium.validation.handlers'));
		$this->validator->check($data);

	}
	


	/**
	* Gets the first premium of a given business
	*
	* @param string $businessType
	* @param array $data
	*
	* @return mixed
	*/
	public function getFirstPremium($businessType, array $data){
		$calculator = $this->makeCalculator($businessType);
		return $calculator->firstPremium($data);
	}


	/**
	* Gets the premium for an existing premium
	*
	* @param string $businessType
	* @param Policy $policy
	*
	* @return mixed
	*/
	public function getPremium($businessType, Policy $policy){
		return $this->makeCalculator($businessType)->getPremium($policy);
	}


	/**
	* Makes a premium calculator for the premium service
	*
	* @param string $businessType
	*
	* @return PremiumCalculatorInterface
	*/
	private function makeCalculator($businessType){
		return app($businessType.'.calculator');
	}

}