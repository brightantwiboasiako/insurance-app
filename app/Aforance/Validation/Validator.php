<?php 

namespace Aforance\Aforance\Validation;

use ValidationException;
use Aforance\Aforance\Validation\ValidationInterface;

abstract class Validator implements ValidationInterface{

	protected $validator;


	/**
	*
	* @throws ValidationException
	*/
	protected function validate($data, $rules){
		$this->validator = \Validator::make($data, $rules);

		if(!$this->validator->passes()){
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
		return $this->validator->getMessageBag()->toArray();
	}


}