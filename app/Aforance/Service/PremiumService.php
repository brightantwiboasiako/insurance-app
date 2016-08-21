<?php 

namespace Aforance\Aforance\Service;

use Aforance\Aforance\Business\Business;
use Aforance\Aforance\Contracts\Business\Policy;
use Aforance\Aforance\Policy\PolicyActionListenerInterface;
use Aforance\Aforance\Premium\Calculators\PeriodicPremiumCalculator;
use Aforance\Aforance\Premium\FatalVerificationException;
use Aforance\Aforance\Premium\PremiumRepository;
use Aforance\Aforance\Service\Contracts\ServiceInterface;
use Aforance\Aforance\Premium\Calculators\PremiumCalculatorInterface;
use Aforance\Aforance\Support\Contracts\Checker;
use Aforance\Aforance\Support\Permission\CanCheckPermission;
use Aforance\Aforance\Validation\ValidationException;
use Aforance\Aforance\Validation\Validator;
use Aforance\Events\PremiumPaid;
use Money\Money;

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

		    $business = $this->policyService->business($data['business_type']);

			// Manage the premium payment

            $manager = app('premium.payment.manager');

            try{

                $manager->manage($data, $policyNumber, $business, $listener);

            }catch(ValidationException $e){
                return $listener->onFailedAction($listener->getAction(), [
                    'reason' => 'validation',
                    'errors' => $manager->errors()
                ]);
            }catch(FatalVerificationException $e){
                return $listener->onFailedAction($listener->getAction(), [
                    'reason' => 'fatal',
                    'message' => $e->getMessage()
                ]);
            }

            return $listener->onSuccessfulAction($listener->getAction(), []);

		}else{
			return $listener->onFailedAction($listener->getAction(), [
				'reason' => 'permission'
			]);
		}

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