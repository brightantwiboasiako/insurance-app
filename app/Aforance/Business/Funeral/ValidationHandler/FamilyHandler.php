<?php
/**
 * Created by PhpStorm.
 * User: Bright
 * Date: 7/27/2016
 * Time: 3:11 PM
 */

namespace Aforance\Aforance\Business\Funeral\ValidationHandler;


use Aforance\Aforance\Business\Funeral\Contracts\FuneralValidationHandler;
use Aforance\Aforance\Validation\ValidationException;
use Aforance\Aforance\Validation\Validator;
use Illuminate\Support\Collection;

class FamilyHandler implements FuneralValidationHandler
{

    public function __construct()
    {
        $this->extendValidator();
    }


    public function handle(array $data, Validator $validator, Collection $errors)
    {
        $familyErrors = [];
        foreach($data['policy_details']['family'] as $key => $family){
            try{
                $validator->validate($family, $this->rules($family));
            }catch(ValidationException $e){
                $familyErrors[$key] = $validator->getErrors();
            }
        }

        if(!empty($familyErrors)) $errors->put('family', $familyErrors);
    }


    public function rules($family)
    {
        return [
            'age' => 'family_age:'.$family['relationship'],
            'relationship' => 'in:child,spouse,business_partner,parent,in_law'
        ];
    }

    /**
     * Checks if a family member's age is valid
     *
     * @param $age
     * @param $relationship
     * @return bool
     */
    private function checkFamilyAge($age, $relationship){
        switch($relationship){
            case 'child':
                return $age >= 10 && $age <= 20;
            case 'spouse' || 'business_partner':
                return $age >= 20 && $age <= 60;
            default:
                return $age >= 45 && $age <= 80;
        }
    }


    private function extendValidator(){
        \Validator::extend('family_age', function($attribute, $value, $parameters, $validator){
            return $this->checkFamilyAge($value, $parameters[0]);
        });

        \Validator::replacer('family_age', function($message, $attribute, $rule, $parameters) {
            return 'Age of '. $parameters[0] .' is invalid.';
        });
    }


}