<?php 

namespace Aforance\Aforance\Support\Permission;

class UnauthorizedActivityException extends \Exception{

	public function __construct($message){
		parent::__construct($message);
	}

}