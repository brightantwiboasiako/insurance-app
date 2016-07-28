<?php
/**
 * Created by PhpStorm.
 * User: Bright
 * Date: 7/23/2016
 * Time: 10:01 AM
 */

namespace Aforance\Aforance\Contracts\Business;


interface PolicyNumberGenerator
{
    /**
     * Generates a policy number
     *
     * @param Policy|null $policy
     * @return string
     */
    public function generate(Policy $policy = null);
}