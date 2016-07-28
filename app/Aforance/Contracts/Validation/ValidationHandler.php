<?php
/**
 * Created by PhpStorm.
 * User: Bright
 * Date: 7/27/2016
 * Time: 2:40 PM
 */

namespace Aforance\Aforance\Contracts\Validation;


interface ValidationHandler
{
    public function rules();
    public function errors();
}