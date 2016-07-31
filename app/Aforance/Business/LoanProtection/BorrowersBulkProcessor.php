<?php
/**
 * Created by PhpStorm.
 * User: Bright
 * Date: 7/31/2016
 * Time: 4:50 PM
 */

namespace Aforance\Aforance\Business\LoanProtection;


use Aforance\Aforance\Support\Contracts\BulkProcessor;
use Aforance\Aforance\Validation\ValidationException;

class BorrowersBulkProcessor implements BulkProcessor
{

    /**
     * Keeps all successful processes
     * 
     * @var array
     */
    private $successful = [];

    /**
     * Keeps all failed processes
     * 
     * @var array
     */
    private $failed = [];


    /**
     * The entire data to be processed
     *
     * @var array
     */
    private $data;


    /**
     * Indicates whether the processor has errors
     *
     * @var bool
     */
    private $hasErrors = false;


    /**
     * @var LoanProtectionBusiness
     */
    private $business;


    /**
     * The policy number of the policy
     *
     * @var string
     */
    private $policyNumber;


    public function __construct(array $data, $policyNumber, LoanProtectionBusiness $business)
    {
        $this->data = $data;
        $this->business = $business;
        $this->policyNumber = $policyNumber;
        $this->run(); // run the processor right away. That's what it's needed for!
    }


    public function getFailed()
    {
        return $this->failed;
    }

    public function getSuccessful()
    {
        return $this->successful;
    }

    public function hasErrors(){
        return $this->hasErrors;
    }

    public function run()
    {

        foreach($this->data as $key => $data){

            if(!is_array($data)){
                $this->addToFailed($key, $data);
                continue;
            }

            $data = $this->buildBorrower($data);
            // Validate data
            try{
                $this->business->checkBorrowerData(['borrowers' => [$data]]);
            }catch(ValidationException $e){
                if(!$this->hasErrors()) $this->hasErrors = true;
                $this->addToFailed($key, $data);
                continue;
            }
            // Validation passed
            // Add borrower to successful
            $this->successful[] = $data;
        }

        // Store borrowers to persistence
        $this->business->storeBorrowers($this->successful, $this->policyNumber);

    }


    private function addToFailed($key, $data){
        $this->failed[$key] = $data;
    }


    public function batchCount(){
        return count($this->data);
    }


    /**
     * Adds right keys to borrower data
     *
     * @param array $data
     * @return array
     */
    private function buildBorrower(array $data){
        return [
            'loan_amount' => (isset($data[0])) ? $data[0] : null,
            'premium' => (isset($data[1])) ? $data[1] : null,
            'issue_date' => (isset($data[2])) ? $data[2] : null,
            'term' => (isset($data[3])) ? $data[3] : null,
            'name' => (isset($data[4])) ? $data[4] : null,
            'gender' => (isset($data[5])) ? $data[5] : null,
            'birthday' => (isset($data[6])) ? $data[6] : null,
            'phone' => (isset($data[7])) ? $data[7] : null
        ];
    }


}