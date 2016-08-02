<?php
/**
 * Created by PhpStorm.
 * User: Bright
 * Date: 8/1/2016
 * Time: 2:27 AM
 */

namespace Aforance\Aforance\Contracts\Business;


interface InvestmentLinked
{

    /**
     * Gets the investment yield rate of the policy
     *
     * @return float
     */
    public function investmentYieldRate();

}