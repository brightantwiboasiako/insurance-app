<?php
/**
 * Created by PhpStorm.
 * User: Bright
 * Date: 8/1/2016
 * Time: 2:20 AM
 */

namespace Aforance\Aforance\Business\ChildEducation;


use Aforance\Aforance\Contracts\Business\Policy;
use Aforance\Aforance\Repository\Contracts\PolicyRepositoryInterface;
use Aforance\ChildEducationPolicy;

class ChildEducationRepository implements PolicyRepositoryInterface
{
    public function create(array $data)
    {
        return ChildEducationPolicy::issue($data);
    }

    public function last()
    {
        return ChildEducationPolicy::orderBy('id', 'DESC')->first();
    }

    public function getPolicyByNumber($policyNumber)
    {
        return ChildEducationPolicy::where('policy_number', $policyNumber)->first();
    }


}