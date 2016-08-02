<?php
/**
 * Created by PhpStorm.
 * User: Bright
 * Date: 7/31/2016
 * Time: 8:04 PM
 */

namespace Aforance\Aforance\Business\ChildEducation;


use Aforance\Aforance\Business\Business;
use Aforance\Aforance\Policy\PolicyCreationListenerInterface;
use Aforance\Aforance\Repository\Contracts\PolicyRepositoryInterface;
use Aforance\Aforance\Repository\CustomerRepository;
use Aforance\Aforance\Support\DateHelper;
use Aforance\Aforance\Validation\ValidationException;

class ChildEducationBusiness extends Business
{

    /**
     * @var CustomerRepository
     */
    private $customers;

    public function __construct(PolicyRepositoryInterface $policies)
    {
        parent::__construct($policies);
        $this->notifier = app('customer.notifier');
        $this->customers = app('customer.repository');
    }


    public function issue(array $data, PolicyCreationListenerInterface $listener)
    {

        // Set validation handlers
        $this->setValidationHandlers(app('childeducation.validation.handlers')['issue']);

        // Validate all policy data
        try{
            parent::validate($data);
        }catch(ValidationException $e){
            return $listener->onFailedCreation([
               'reason' => 'validation',
                'errors' => $this->validator->errors()
            ]);
        }catch(\Exception $e){
            return $listener->onFailedCreation([
                'reason' => 'fatal',
                'message' => $e->getMessage()
            ]);
        }

        // get customer's age for premium computation
        $data['age'] = DateHelper::ageNextBirthday($this->customers->find($data['customer_id'])->birthday());

        // Get the first premium
        $data['premium'] = $this->premiumService->getFirstPremium('childeducation', $data);

        // set policy number
        $data['policy_number'] = app('childeducation.number_generator')->generate($this->policies->last());

        $policy = parent::createPolicy($data);
        return $listener->onSuccessfulCreation([
           'policy' => $policy
        ]);

    }


    public function renderDocument($policyNumber, $action)
    {
        $document = app('childeducation.document');
        return $document->handle($policyNumber, $action);
    }

}