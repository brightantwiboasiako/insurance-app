<?php 

namespace Aforance\Aforance\Business;

use Aforance\Aforance\Contracts\Business\DocumentRenderer;
use Aforance\Aforance\Contracts\Business\Policy;
use Aforance\Aforance\Contracts\Business\PolicyIssuer;
use Aforance\Aforance\Notification\Contracts\CustomerNotificationInterface;
use Aforance\Aforance\Premium\Calculators\PeriodicPremiumCalculator;
use Aforance\Aforance\Premium\PremiumRepository;
use Aforance\Aforance\Repository\Contracts\PolicyRepositoryInterface;
use Aforance\Aforance\Service\PremiumService;
use Aforance\Aforance\Validation\ValidationException;
use Aforance\Aforance\Validation\ValidationInterface;
use Carbon\Carbon;
use Money\Money;

abstract class Business  implements PolicyIssuer, DocumentRenderer{

	/**
	* The validator instance
	* @var ValidationInterface
	*/
	protected $validator;


	/**
	* The premium service instance
	* @var PremiumService
	*/
	protected $premiumService;	


	/**
	* The policy repository instance
	* @var PolicyRepositoryInterface
	*/
	protected $policies;


	/**
	*
	* @var CustomerNotificationInterface
	*/
	protected $notifier;


	/**
	 * Business constructor.
	 * @param PolicyRepositoryInterface $policies
	 */
	public function __construct(PolicyRepositoryInterface $policies){
		// Get global validator instance
		$this->validator = app('aforance.validator');
		// Set the policy repository
		$this->policies = $policies;
		// Get an instance of the premium service
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
	 * @throws \Exception
	*/
	public function validate(array $data){
		try{
			$this->validator->check($data);
		}catch(ValidationException $e){
			throw $e;
		}catch(\Exception $e){
			throw $e;
		}
	}


	/**
	 * Gets a policy using the policy's number
	 *
	 * @param $policyNumber
	 * @return Policy
	 */
	public function getPolicyByNumber($policyNumber){
		return $this->policies->getPolicyByNumber($policyNumber);
	}

	/**
	 * Sets the validation handlers for validation
	 *
	 * @param array $handlers
	 */
	protected function setValidationHandlers(array $handlers){
		$this->validator->setHandlers($handlers);
	}

	/**
	 * Processes premium payments of a given policy
	 * Other businesses may override this algorithm
	 *
	 * @param array $data
	 * @param Policy $policy
	 * @param PremiumRepository $premiums
	 */
	public function handlePremiumPayment(array $data, Policy $policy, PremiumRepository $premiums){

		$frequencyFactor = PeriodicPremiumCalculator::getFrequencyFactor($policy->premiumFrequency());

		// Get start period
		$period = new Carbon($data['period']);
		// Weight amounts by the payment frequency factor
		$amountPaid = Money::withRaw($data['amount_paid']);
		$amountPaid->times((double)(1/$frequencyFactor));

		$amountExpected = Money::withRaw($data['amount_expected']);
		$amountExpected->times((double)(1/$frequencyFactor));

		// Loop through all periods and credit premium
		for($i = 0; $i < $frequencyFactor; $i++){
			$data['period'] = $period->addMonths($i);
			$data['amount_paid'] = $amountPaid->getSecure();
			$data['amount_expected'] = $amountExpected->getSecure();
			$data['receipt_code'] = 1; // Generate receipt code
			$premiums->create($data);
		}
	}

}