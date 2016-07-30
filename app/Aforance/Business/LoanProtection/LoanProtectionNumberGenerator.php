<?php
/**
 * Created by PhpStorm.
 * User: Bright
 * Date: 7/30/2016
 * Time: 6:52 AM
 */

namespace Aforance\Aforance\Business\LoanProtection;


use Aforance\Aforance\Policy\NumberGenerator;

class LoanProtectionNumberGenerator extends NumberGenerator
{
    
    public function __construct()
    {
        parent::__construct();
        $this->policyCode = config('policy.loanprotection.code');
    }


    public function combine($number){
        return $this->companyCode().
                $this->policyCode().
                str_pad($number, $this->digits, '0', STR_PAD_LEFT);
    }

}