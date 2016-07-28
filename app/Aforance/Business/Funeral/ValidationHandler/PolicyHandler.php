<?php
/**
 * Created by PhpStorm.
 * User: Bright
 * Date: 7/27/2016
 * Time: 2:42 PM
 */

namespace Aforance\Aforance\Business\Funeral\ValidationHandler;


use Aforance\Aforance\Business\Funeral\Contracts\FuneralValidationHandler;
use Aforance\Aforance\Validation\ValidationException;
use Aforance\Aforance\Validation\Validator;
use Illuminate\Support\Collection;

class PolicyHandler implements FuneralValidationHandler
{

    public function __construct()
    {
        $this->extendValidator();
    }


    public function rules()
    {
        return [
            'sum_assured' => 'required|numeric|min:1',
            'issue_date' => 'required|date|before:tomorrow',
            'automatic_update_percentage' => 'required|numeric|min:0',
            'bank_name' => 'max:64',
            'account_number' => 'max:32',
            'mode_of_payment' => 'required',
            'payment_frequency' => 'required',
            'accidental_rider' => 'required',
        ];
    }


    public function handle(array $data, Validator $validator, Collection $errors)
    {
        try{
            $validator->validate($data['policy_details'], $this->rules());
        }catch(ValidationException $e){
            $errors->put('policy', $validator->getErrors());
        }
    }
    
    
    private function extendValidator(){
        \Validator::extend('primary_age', function($attribute, $value, $parameters, $validator){
            return $value >= 20 && $value <= 60;
        });

        \Validator::replacer('primary_age', function($message, $attribute, $rule, $parameters) {
            return 'Age of primary relationship is not valid.';
        });
    }

}