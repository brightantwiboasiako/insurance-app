<?php
/**
 * Created by PhpStorm.
 * User: Bright
 * Date: 8/2/2016
 * Time: 7:25 PM
 */

namespace Aforance\Aforance\Premium\Verifier;


use Aforance\Aforance\Contracts\PremiumVerifier;
use Money\Money;

class AmountDisparityVerifier implements PremiumVerifier
{

    public function verify(array &$data)
    {
        $expected = Money::withRaw($data['amount_expected']);
        $paid = Money::withRaw($data['amount_paid']);

        if($expected->greaterThan($paid)){
            $data['is_complete'] = 0; // indicate that the premium is not complete
        }else{
            $data['is_complete'] = 1;
        }
    }

}