<?php
/**
 * Created by PhpStorm.
 * User: Bright
 * Date: 7/31/2016
 * Time: 9:03 PM
 */

namespace Aforance\Aforance\Business\ChildEducation\Validation;


use Aforance\Aforance\Contracts\Validation\ValidationHandler;
use Aforance\Aforance\Validation\ValidationException;
use Aforance\Aforance\Validation\Validator;
use Illuminate\Support\Collection;

class PolicyHandler implements ValidationHandler
{

    public function handle(array $data, Validator $validator, Collection $errors)
    {
        // If the data is not set, then why the heck are we here?
        if(!isset($data['policy_details'])){
            throw new \Exception('Policy information not found!');
        }

        try{
            $validator->validate($data['policy_details'], $this->rules());
        }catch(ValidationException $e){
            $errors->put('policy_details', $validator->getErrors());
        }
    }


    public function rules(){
        return [
            'sum_assured' => 'required|numeric|min:0',
            'issue_date' => 'required|date|before:tomorrow',
            'bank.name' => 'max:64',
            'bank.account_number' => 'max:32',
        ];
    }

}