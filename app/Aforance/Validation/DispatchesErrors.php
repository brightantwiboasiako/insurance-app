<?php 

namespace Aforance\Aforance\Validation;

trait DispatchesErrors{


	public function addToBag($key, $messages){
		$this->errors[$key] = $messages;
	}


	public function addAllToBag(array $collection){
		foreach($collection as $key => $error){
			$this->addToBag($key, $error);
		}
	}


	public function dispatch(){
		return $this->errors;
	}

}