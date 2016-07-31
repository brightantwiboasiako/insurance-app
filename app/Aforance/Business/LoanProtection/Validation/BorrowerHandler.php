<?php
/**
 * Created by PhpStorm.
 * User: Bright
 * Date: 7/29/2016
 * Time: 8:07 AM
 */

namespace Aforance\Aforance\Business\LoanProtection\Validation;


use Aforance\Aforance\Contracts\Validation\ValidationHandler;
use Aforance\Aforance\Validation\ValidationException;
use Aforance\Aforance\Validation\Validator;
use Illuminate\Support\Collection;

class BorrowerHandler implements ValidationHandler
{

    public function handle(array $data, Validator $validator, Collection $errors)
    {
        if(!isset($data['borrowers'])) return;

        $borrowerErrors = [];

        foreach($data['borrowers'] as $key => $borrower){

            try{
                $validator->validate($borrower, $this->rules());
            }catch (ValidationException $e){
                $borrowerErrors[$key] = $validator->getErrors();
            }catch(\Exception $e){/*intentionally left blank*/}

        }

        if(!empty($borrowerErrors)) $errors->put('borrowers', $borrowerErrors);

    }


    public function rules(){
        return [
            'loan_amount' => 'required|numeric|min:0',
            'issue_date' => 'required|date',
            'term' => 'required|numeric|min:0',
            'premium' => 'required|numeric|min:0',
            'name' => 'required|min:2|max:64',
            'birthday' => 'required|date',
            'phone' => 'min:10|max:15',
            'gender' => 'in:Male,Female'
        ];
    }


}