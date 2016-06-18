<?php 

namespace Aforance\Aforance\Validation;

interface ValidationInterface{

	public function passes();
	public function fails();
	public function getErrors();

}