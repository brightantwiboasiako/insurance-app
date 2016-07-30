<?php
/**
 * Created by PhpStorm.
 * User: Bright
 * Date: 7/27/2016
 * Time: 2:40 PM
 */

namespace Aforance\Aforance\Contracts\Validation;


use Aforance\Aforance\Validation\Validator;
use Illuminate\Support\Collection;

interface ValidationHandler
{
    public function handle(array $data, Validator $validator, Collection $errors);
}