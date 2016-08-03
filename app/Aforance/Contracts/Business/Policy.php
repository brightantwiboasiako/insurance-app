<?php
/**
 * Created by PhpStorm.
 * User: Bright
 * Date: 7/23/2016
 * Time: 10:13 AM
 */

namespace Aforance\Aforance\Contracts\Business;


use Money\Money;

interface Policy
{

    /**
     * The policy number of the policy
     *
     * @return string
     */
    public function policyNumber();
    /**
     * Returns a structure with all the various
     * premium components of the policy
     *
     * @return mixed
     */
    public function premiumStructure();
    /**
     * The payment frequency of the policy's premium
     *
     * @return string
     */
    public function premiumFrequency();
    /**
     * The premium amount for the policy based 
     * on the payment frequency
     * 
     * @return Money
     */
    public function premium();
}