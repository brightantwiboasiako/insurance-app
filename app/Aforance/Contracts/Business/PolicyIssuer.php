<?php
/**
 * Created by PhpStorm.
 * User: Bright
 * Date: 7/23/2016
 * Time: 7:28 AM
 */

namespace Aforance\Aforance\Contracts\Business;


use Aforance\Aforance\Policy\PolicyCreationListenerInterface;

interface PolicyIssuer
{

    public function issue(array $data, PolicyCreationListenerInterface $listener);

}