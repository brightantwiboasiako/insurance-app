<?php
/**
 * Created by PhpStorm.
 * User: Bright
 * Date: 7/27/2016
 * Time: 2:54 PM
 */

namespace Aforance\Aforance\Business\Funeral\Contracts;

use Aforance\Aforance\Validation\Validator;
use Illuminate\Support\Collection;

interface FuneralValidationHandler
{
    public function handle(array $data, Validator $validator, Collection $errors);
}