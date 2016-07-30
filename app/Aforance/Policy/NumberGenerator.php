<?php
/**
 * Created by PhpStorm.
 * User: Bright
 * Date: 7/30/2016
 * Time: 6:57 AM
 */

namespace Aforance\Aforance\Policy;


use Aforance\Aforance\Contracts\Business\Policy;
use Aforance\Aforance\Contracts\Business\PolicyNumberGenerator;
use Carbon\Carbon;

abstract class NumberGenerator implements PolicyNumberGenerator
{

    /**
     * @var Carbon
     */
    private $now;

    /**
     * Number of digits used in the policy number
     * 
     * @var int
     */
    protected $digits = 5;


    /**
     * The policy code
     *
     * @var string null
     */
    protected $policyCode = null;
    

    public function __construct()
    {
        $this->now = Carbon::now();
    }

    /**
     * Generates a policy number for funeral policies
     *
     * @param Policy|null $policy
     * @return string
     */
    public function generate(Policy $policy = null)
    {
        if($policy){
            $start = strlen($policy->policyNumber()) - $this->digits;
            $number = substr($policy->policyNumber(), $start);
            return $this->combine(((int)$number) + 1);
        }

        return $this->combine(1);
    }


    public abstract function combine($number);


    /**
     * Gets the company code
     *
     * @return string
     */
    protected function companyCode(){
        return config('company.code');
    }


    /**
     * Gets the current year as a string
     *
     * @return string
     */
    protected function year(){
        return $this->now->format('Y');
    }

    /**
     * Gets the current month as a string
     *
     * @return string
     */
    protected function month(){
        return $this->now->format('m');
    }

    /**
     * Gets the policy code for the policy
     *
     * @return string
     */
    protected function policyCode(){
        return $this->policyCode;
    }

}