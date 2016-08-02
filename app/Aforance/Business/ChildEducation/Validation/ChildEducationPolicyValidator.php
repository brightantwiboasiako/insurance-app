<?php
/**
 * Created by PhpStorm.
 * User: Bright
 * Date: 7/31/2016
 * Time: 8:52 PM
 */

namespace Aforance\Aforance\Business\ChildEducation\Validation;


use Aforance\Aforance\Validation\CanCheckPolicyData;
use Aforance\Aforance\Validation\PolicyValidatorInterface;
use Aforance\Aforance\Validation\Validator;
use Illuminate\Support\Collection;

class ChildEducationPolicyValidator extends Validator implements PolicyValidatorInterface
{
    use CanCheckPolicyData;

    private $errors;

    private $handlers;


    public function __construct()
    {
        $this->errors = new Collection;
        $this->setHandlers(app('childeducation.validation.handlers'));
    }


    public function errors()
    {
        return $this->errors;
    }

    public function setHandlers(array $handlers)
    {
        $this->handlers = $handlers;
    }


}