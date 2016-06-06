<?php 

namespace Aforance\Aforance\Support\Contracts;

/**
* Interface for data parsing
* of json, xml, etc.
*
*/


interface Parser{

	public function read($key);

	public function raw();

}