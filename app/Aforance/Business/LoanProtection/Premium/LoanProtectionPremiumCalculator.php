<?php
/**
 * Created by PhpStorm.
 * User: Bright
 * Date: 7/29/2016
 * Time: 9:02 AM
 */

namespace Aforance\Aforance\Business\LoanProtection\Premium;

use Aforance\Aforance\Contracts\Business\Policy;
use Aforance\Aforance\Premium\Calculators\PremiumCalculatorInterface;

class LoanProtectionPremiumCalculator implements PremiumCalculatorInterface
{

    public function firstPremium($data)
    {
        return 0;
    }

    public function getPremium(Policy $policy)
    {
        return $policy->premium();
    }

}