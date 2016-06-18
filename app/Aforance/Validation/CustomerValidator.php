<?php 

namespace Aforance\Aforance\Validation;


use Aforance\Aforance\Validation\ValidationException;

class CustomerValidator extends Validator{


	public function registrationValidation($data){

            $this->validate($data, $this->getRules());

	}


	private function getRules($id = null){

		return [
            'title' => 'required',
            'surname' => 'required|max:64',
            'first_name' => 'required|max:32',
            'other_name' => 'max:32',
            'email' => 'required|email|unique:customers,email,'.$id,
            'primary_phone_number' => 'required|max:15',
            'personal_address' => 'required|max:1024',
            'gender' => 'required',
            'birth_day' => 'required',
            'occupation' => 'required|max:128',
            'employer_name' => 'required|max:64',
            'employer_address' => 'required|max:1024'
        ];
	}

}