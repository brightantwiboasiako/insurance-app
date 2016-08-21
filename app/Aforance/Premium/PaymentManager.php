<?php
/**
 * Created by PhpStorm.
 * User: Bright
 * Date: 8/20/16
 * Time: 9:12 PM
 */

namespace Aforance\Aforance\Premium;


use Aforance\Aforance\Business\Business;
use Aforance\Aforance\Contracts\Business\Policy;
use Aforance\Aforance\Contracts\Premium;
use Aforance\Aforance\Policy\PolicyActionListenerInterface;
use Aforance\Aforance\Premium\Calculators\PeriodicPremiumCalculator;
use Aforance\Aforance\Validation\ValidationException;
use Aforance\Aforance\Validation\Validator;
use Carbon\Carbon;
use Money\Money;

class PaymentManager
{

    /**
     * Validator instance
     *
     * @var Validator
     */
    private $validator;


    /**
     * @var PremiumRepository
     */
    private $premiums;


    public function __construct()
    {
        $this->premiums = app('premium.repository');
        $this->validator = app('aforance.validator');
    }


    /**
     * Manages a premium payment
     *
     * @param array $data
     * @param $policyNumber
     * @param Business $business
     * @param PolicyActionListenerInterface $listener
     * @throws \Exception
     */
    public function manage(array $data, $policyNumber, Business $business, PolicyActionListenerInterface $listener){

        $policy = $business->getPolicyByNumber($policyNumber);

        // validate data
        $this->validation($data, $policy);

        // handle the processing
        $this->process($data, $policy, $business);

        // notify client about payment

    }


    /**
     * Processes the premium payment
     *
     * @param array $data
     * @param Policy $policy
     * @param Business $business
     */
    private function process(array $data, Policy $policy, Business $business){
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
            $data['receipt_code'] = 1; // TODO Generate receipt code
            $premium = $this->premiums->create($data);

            // credit necessary commission on the premium
            $business->creditCommission($policy, $premium);

        }
    }



    /**
     * Validates the premium data
     *
     * @param array $data
     * @param Policy $policy
     * @throws \Exception
     */
    private function validation(array $data, Policy $policy){

        // Check premium data
        $this->checkPremiumData($data);

        // The expected premium amount
        $data['expected_amount'] = $policy->premium()->getAmount();

        // Verify premium data
        $verifiers = app('premium.verifiers');
        foreach($verifiers as $verifier){
            $verifier->verify($data);
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
     * Gets errors resulting from the management of the premiums
     *
     * @return array
     */
    public function errors(){
        return $this->validator->errors();
    }

}