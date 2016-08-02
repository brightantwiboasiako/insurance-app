<?php
/**
 * Created by PhpStorm.
 * User: Bright
 * Date: 8/1/2016
 * Time: 2:53 AM
 */

namespace Aforance\Aforance\Business\ChildEducation;

use Aforance\Aforance\Policy\NumberGenerator as Generator;

class NumberGenerator extends Generator
{

    public function __construct()
    {
        parent::__construct();
        $this->policyCode = config('policy.childeducation.code');
    }

}