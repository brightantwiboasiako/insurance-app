<?php 

namespace Aforance\Aforance\Validation;

abstract class Validator implements ValidationInterface{

	/**
	 * @var \Illuminate\Validation\Validator
	 */
	protected $validator;


	/**
	 * @param $data
	 * @param $rules
	 * @throws ValidationException
	 * @throws \Exception
	 */
	public function validate($data, $rules){

		if(!is_array($data)){
			throw new \Exception('Validation data must be an array.');
		}

		$this->validator = \Validator::make($data, $rules);
		if(!$this->passes()){
			throw new ValidationException;
		}
	}


	public function passes(){
		return $this->validator->passes();
	}


	public function  fails(){
		return $this->validator->fails();
	}


	public function getErrors(){
		return $this->validator->errors()->toArray();
	}

}