<?php
/**
 * Created by PhpStorm.
 * User: Bright
 * Date: 7/29/2016
 * Time: 7:45 AM
 */

namespace Aforance\Aforance\Business\LoanProtection;


use Aforance\Aforance\Business\Business;
use Aforance\Aforance\Business\LoanProtection\Contracts\LoanProtectionRepositoryInterface;
use Aforance\Aforance\Policy\PolicyCreationListenerInterface;
use Aforance\Aforance\Validation\CanCheckPolicyData;
use Aforance\Aforance\Validation\PolicyValidatorInterface;
use Aforance\Aforance\Validation\ValidationException;

class LoanProtectionBusiness extends Business
{

    public function __construct(PolicyValidatorInterface $validator, LoanProtectionRepositoryInterface $repository)
    {
        parent::__construct($validator, $repository);
        $this->notifier = app('loanprotection.customer_notifier');
    }


    public function renderDocument($policyNumber, $action)
    {
        // TODO: Implement renderDocument() method.
    }

    /**
     * Issues a new loan protection business
     *
     * @param array $data
     * @param PolicyCreationListenerInterface $listener
     * @return mixed
     */
    public function issue(array $data, PolicyCreationListenerInterface $listener)
    {
        // handle policy validation
        try{
            // validate policy data
            parent::validate($data);
        }catch(ValidationException $e){
            return $listener->onFailedCreation([
                'reason' => 'validation',
                'errors' => $this->validator->errors()
            ]);
        }

        // get first premium
        $data['premium'] = $this->premiumService->getFirstPremium('loan protection', $data);

        // add policy number
        $data['policy_number'] = app('loanprotection.number_generator')->generate($this->policies->last());
        
        // create loan protection policy
        $policy = parent::createPolicy($data);
        
        return $listener->onSuccessfulCreation([
            'number' => $policy->policyNumber()
        ]);

    }


}