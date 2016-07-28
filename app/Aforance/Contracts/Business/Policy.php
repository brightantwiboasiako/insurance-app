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
    public function policyNumber();
    public function premiumStructure();
    public function premiumFrequency();

    /**
     * 
     * @return Money
     */
    public function sumAssured();
}