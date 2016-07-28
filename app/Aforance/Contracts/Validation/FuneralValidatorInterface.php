<?php
/**
 * Created by PhpStorm.
 * User: Bright
 * Date: 7/23/2016
 * Time: 7:51 AM
 */

namespace Aforance\Aforance\Contracts\Validation;


use Aforance\Aforance\Validation\PolicyValidatorInterface;

interface FuneralValidatorInterface extends PolicyValidatorInterface
{
    public function errors();
}