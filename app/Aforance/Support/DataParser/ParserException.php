<?php 

namespace Aforance\Aforance\Support\DataParser;

class ParserException extends \Exception{

	public function __construct($message){
		parent::__construct($message);
	}

}