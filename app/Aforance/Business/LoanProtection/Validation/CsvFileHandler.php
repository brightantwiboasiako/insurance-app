<?php
/**
 * Created by PhpStorm.
 * User: Bright
 * Date: 7/31/2016
 * Time: 2:47 PM
 */

namespace Aforance\Aforance\Business\LoanProtection\Validation;


use Aforance\Aforance\Contracts\Validation\ValidationHandler;
use Aforance\Aforance\Validation\ValidationException;
use Aforance\Aforance\Validation\Validator;
use Illuminate\Support\Collection;

class CsvFileHandler implements ValidationHandler
{

    public function handle(array $data, Validator $validator, Collection $errors)
    {
        try{
            $validator->validate($data, $this->rules());
        }catch(ValidationException $e){
            $errors->put('file', $validator->getErrors());
        }
    }


    public function rules(){
        return [
            'loans' => 'required|file|mimes:csv,txt|max:1024'
        ];
    }


}