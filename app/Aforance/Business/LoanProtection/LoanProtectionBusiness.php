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
use Aforance\Aforance\Policy\PolicyActionListenerInterface;
use Aforance\Aforance\Policy\PolicyCreationListenerInterface;
use Aforance\Aforance\Validation\PolicyValidatorInterface;
use Aforance\Aforance\Validation\ValidationException;
use Illuminate\Http\UploadedFile;

class LoanProtectionBusiness extends Business
{

    public function __construct(PolicyValidatorInterface $validator, LoanProtectionRepositoryInterface $repository)
    {
        parent::__construct($validator, $repository);
        $this->notifier = app('loanprotection.customer_notifier');
    }


    public function renderDocument($policyNumber, $action)
    {
        $document = app('loanprotection.document');
        return $document->handle($policyNumber, $action);
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
        $data['premium'] = $this->premiumService->getFirstPremium('loanprotection', $data);

        // add policy number
        $data['policy_number'] = app('loanprotection.number_generator')->generate($this->policies->last());
        
        // create loan protection policy
        $policy = parent::createPolicy($data);
        
        return $listener->onSuccessfulCreation([
            'number' => $policy->policyNumber()
        ]);

    }


    /**
     *
     *
     * @param $policyNumber
     * @param UploadedFile $file
     * @param $includeFirstRow
     * @param PolicyActionListenerInterface $listener
     * @return mixed
     */
    public function addUploadedBorrowers($policyNumber, UploadedFile $file, $includeFirstRow,
                                         PolicyActionListenerInterface $listener){

        // Validate file info
        $this->validator->setHandlers([app('loanprotection.validation.upload')]);
        try{
            parent::validate(['loans' => $file]);
        }catch (ValidationException $e){
            return $listener->onFailedAction($listener->getAction(), [
               'reason' => 'validation',
                'errors' => $this->validator->errors()
            ]);
        }catch(\Exception $e){
            // Something really bad has happened
            // Like user uploaded file with weird data
            return $listener->onFailedAction($listener->getAction(), [
                'reason' => 'fatal',
                'error' => 'File Contains invalid data'
            ]);
        }

        // Extract the content of csv file
        $data = app('filereader.csv')->read($file->getRealPath());

        if(!$includeFirstRow) array_shift($data);

        // process borrowers data
        $processor = new BorrowersBulkProcessor($data, $policyNumber, $this);

        if($processor->hasErrors()){
            return $listener->onFailedAction($listener->getAction(), [
                'reason' => 'processing',
                'success' => $processor->getSuccessful(),
                'failed' => $processor->getFailed(),
                'count' => $processor->batchCount()
            ]);
        }

        return $listener->onSuccessfulAction($listener->getAction(), []);

    }



    /**
     * Adds a borrower to a policy
     *
     * @param array $data
     * @param $policyNumber
     * @param PolicyActionListenerInterface $listener
     * @return mixed
     */
    public function addBorrower(array $data, $policyNumber,PolicyActionListenerInterface $listener){

        // validate data
        try{
            $this->checkBorrowerData($data);
        }catch(ValidationException $e){
            return $listener->onFailedAction($listener->getAction(),
                    ['reason' => 'validation', 'errors' => $this->validator->errors()]);
        }
        // store borrower
        $this->storeBorrowers($data['borrowers'], $policyNumber);
        
        return $listener->onSuccessfulAction($listener->getAction(), []);
    }


    public function storeBorrowers(array $borrowers, $policyNumber){
        $this->policies->getPolicyByNumber($policyNumber)->addBorrowers($borrowers);
    }



    /**
     * Checks the data of a borrower
     *
     * @param $data
     * @throws ValidationException
     * @throws \Exception
     */
    public function checkBorrowerData(array $data){
        // set the validation handler
        $this->validator->setHandlers([app('loanprotection.validation.borrower')]);
        try{
            parent::validate($data);
        }catch(ValidationException $e){
            throw $e;
        }
    }


}