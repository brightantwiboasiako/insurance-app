<?php
/**
 * Created by PhpStorm.
 * User: Bright
 * Date: 7/29/2016
 * Time: 8:36 AM
 */

namespace Aforance\Aforance\Business\LoanProtection;


use Aforance\Aforance\Business\LoanProtection\Contracts\LoanProtectionRepositoryInterface;
use Aforance\Aforance\Contracts\Business\Policy;
use Aforance\LoanProtectionPolicy;

class LoanProtectionRepository implements LoanProtectionRepositoryInterface
{
    public function create(array $data)
    {
        return LoanProtectionPolicy::issue($data);
    }

    /**
     * Gets the last policy in the repository
     *
     * @return Policy
     */
    public function last(){
        return LoanProtectionPolicy::last();
    }

    /**
     * @param string $policyNumber
     * @return Policy
     */
    public function getPolicyByNumber($policyNumber)
    {
        return LoanProtectionPolicy::where('policy_number', $policyNumber)->first();
    }


}