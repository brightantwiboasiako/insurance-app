<?php
/**
 * Created by PhpStorm.
 * User: Bright
 * Date: 7/27/2016
 * Time: 3:05 PM
 */

namespace Aforance\Aforance\Business\Funeral\ValidationHandler;


use Aforance\Aforance\Contracts\Validation\ValidationHandler;
use Aforance\Aforance\Validation\ValidationException;
use Aforance\Aforance\Validation\Validator;
use Illuminate\Support\Collection;

class UnderwritingHandler implements ValidationHandler
{
    public function handle(array $data, Validator $validator, Collection $errors)
    {
        try{
            $validator->validate($data['underwriting'], $this->rules());
        }catch(ValidationException $e){
            $errors->put('underwriting', $validator->getErrors());
        }
    }

    public function rules(){
        return [
            'cancer' => 'required',
            'hiv' => 'required',
            'illness' => 'required',
            'declined_proposal' => 'max: 128',
            'doctor_consult' => 'max:255',
            'height' => 'required|numeric|min:1',
            'weight' => 'required|numeric|min:1',
            'good_health' => 'required'
        ];
    }

}