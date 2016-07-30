<?php
/**
 * Created by PhpStorm.
 * User: Bright
 * Date: 7/29/2016
 * Time: 7:47 AM
 */

namespace Aforance\Aforance\Business\LoanProtection\Validation;


use Aforance\Aforance\Validation\CanCheckPolicyData;
use Aforance\Aforance\Validation\PolicyValidatorInterface;
use Aforance\Aforance\Validation\Validator;
use Illuminate\Support\Collection;

class LoanProtectionPolicyValidator extends Validator implements PolicyValidatorInterface
{

    use CanCheckPolicyData;


    /**
     * @var array
     */
    private $handlers;

    /**
     * @var Collection
     */
    private $errors;

    public function __construct()
    {
        $this->handlers = app('loanprotection.validation.handlers');
        $this->errors = new Collection();
    }



    public function errors()
    {
        return $this->errors;
    }


}