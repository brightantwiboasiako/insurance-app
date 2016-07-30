<?php
/**
 * Created by PhpStorm.
 * User: Bright
 * Date: 7/29/2016
 * Time: 8:25 AM
 */

namespace Aforance\Aforance\Validation;


use Aforance\Aforance\Policy\PolicyCreationListenerInterface;

trait CanCheckPolicyData
{

    /**
     * Checks policy data using handlers
     *
     * @param array $data
     *
     * @throws ValidationException
     */
    public function checkPolicyData(array $data){
        foreach($this->handlers as $handler){
            $handler->handle($data, $this, $this->errors);
        }
        if(!$this->errors->isEmpty()) throw new ValidationException;
    }
    

}