<?php
/**
 * Created by PhpStorm.
 * User: Bright
 * Date: 7/23/2016
 * Time: 10:04 AM
 */

namespace Aforance\Aforance\Business\Funeral;

use Aforance\Aforance\Policy\NumberGenerator;

class FuneralNumberGenerator extends NumberGenerator
{
    
    public function __construct()
    {
        parent::__construct();
        $this->policyCode = config('policy.funeral.code');
    }


    /**
     * The algorithm to generate funeral policy numbers
     *
     * @param int $number
     * @return string
     * @override
     */
    public function combine($number){
        return $this->companyCode().
        $this->policyCode().
        $this->year().
        $this->month().
        str_pad($number, $this->digits, '0', STR_PAD_LEFT);
    }

}