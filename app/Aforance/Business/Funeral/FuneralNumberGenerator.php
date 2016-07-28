<?php
/**
 * Created by PhpStorm.
 * User: Bright
 * Date: 7/23/2016
 * Time: 10:04 AM
 */

namespace Aforance\Aforance\Business\Funeral;

use Carbon\Carbon;
use Aforance\Aforance\Contracts\Business\Policy;
use Aforance\Aforance\Contracts\Business\PolicyNumberGenerator;

class FuneralNumberGenerator implements PolicyNumberGenerator
{
    const DIGITS = 5;


    /**
     * Current date instance for policy number generation
     *
     * @var Carbon
     */
    private $now;


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
            $start = strlen($policy->policyNumber()) - static::DIGITS;
            $number = substr($policy->policyNumber(), $start);
            return $this->combine(((int)$number) + 1);
        }

        return $this->combine(1);
    }

    /**
     * @param int $number
     * @return string
     */
    protected function combine($number){
        return $this->companyCode().
                $this->policyCode().
                $this->year().
                $this->month().
                str_pad($number, static::DIGITS, '0', STR_PAD_LEFT);
    }


    /**
     * Gets the company code
     *
     * @return string
     */
    protected function companyCode(){
        return config('company.code');
    }


    /**
     * Gets the policy code for funeral policies
     *
     * @return string
     */
    protected function policyCode(){
        return config('policy.funeral.code');
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

}