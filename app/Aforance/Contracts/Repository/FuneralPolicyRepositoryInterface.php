<?php
/**
 * Created by PhpStorm.
 * User: Bright
 * Date: 7/23/2016
 * Time: 7:53 AM
 */

namespace Aforance\Aforance\Contracts\Repository;


use Aforance\Aforance\Repository\Contracts\PolicyRepositoryInterface;
use Aforance\FuneralPolicy;

interface FuneralPolicyRepositoryInterface extends PolicyRepositoryInterface
{

    /**
     * @param $policyNumber
     * @return FuneralPolicy|null
     */
    public function getByPolicyNumber($policyNumber);

}