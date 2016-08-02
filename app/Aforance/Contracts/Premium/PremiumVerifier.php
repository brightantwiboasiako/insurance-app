<?php
/**
 * Created by PhpStorm.
 * User: Bright
 * Date: 8/2/2016
 * Time: 7:15 PM
 */

namespace Aforance\Aforance\Contracts;


use Aforance\Aforance\Premium\FatalVerificationException;

interface PremiumVerifier
{

    /**
     * Verifies premium data
     * 
     * @param array $data
     * @return mixed
     * @throws FatalVerificationException
     */
    public function verify(array &$data);
    
}