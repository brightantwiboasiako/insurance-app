<?php
/**
 * Created by PhpStorm.
 * User: Bright
 * Date: 7/29/2016
 * Time: 7:58 AM
 */

namespace Aforance\Aforance\Business\LoanProtection\Validation;


use Aforance\Aforance\Contracts\Validation\ValidationHandler;
use Aforance\Aforance\Validation\ValidationException;
use Aforance\Aforance\Validation\Validator;
use Illuminate\Support\Collection;

class FinancierHandler implements ValidationHandler
{

    public function handle(array $data, Validator $validator, Collection $errors)
    {
        try{
            $validator->validate($data['financier'], $this->rules());
        }catch (ValidationException $e){
            $errors->put('financier', $validator->getErrors());
        }
    }


    private function rules($id = null){
        return [
            'name' => 'required|min:2|max:64',
            'address' => 'required|max:255',
            'phone' => 'required|min:10|max:15',
            'email' => 'required|email|unique:loanprotection,institution_email,'.$id,
            'branch' => 'required|max:64'
        ];
    }

}