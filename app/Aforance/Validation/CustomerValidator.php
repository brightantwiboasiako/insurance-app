<?php 

namespace Aforance\Aforance\Validation;

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
            'primary_phone_number' => 'required|max:15|unique:customers,primary_phone_number,'.$id,
            'personal_address' => 'required|max:1024',
            'gender' => 'required',
            'birth_day' => 'required',
            'occupation' => 'required|max:128',
            'employer_name' => 'required|max:64',
            'employer_address' => 'required|max:1024'
        ];
	}

}