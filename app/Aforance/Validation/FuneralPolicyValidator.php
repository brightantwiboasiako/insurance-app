<?php 

namespace Aforance\Aforance\Validation;

use Aforance\Aforance\Contracts\Validation\FuneralValidatorInterface;
use Aforance\Aforance\Validation\ValidationException;
use Aforance\Aforance\Validation\Validator;
use Illuminate\Support\Collection;

class FuneralPolicyValidator extends Validator implements FuneralValidatorInterface{

	/**
	 * @var Collection
	 */
	private $errors;

	/**
	 * @var array
	 */
	private $handlers;

	/**
	 * FuneralPolicyValidator constructor.
	 */
	public function __construct()
	{
		$this->errors = new Collection();
		$this->handlers = app('funeral.validators');
	}


	/**
	 *
	 * @param array $data
	 *
	* @throws ValidationException
	*/
	public function checkPolicyData(array $data){
		foreach($this->handlers as $handler){
			$handler->handle($data, $this, $this->errors);
		}
		if(!$this->errors->isEmpty()) throw new ValidationException;
	}


	/**
	 * Get possible validation errors
	 *
	 * @return array
	 */
	public function errors()
	{
		return $this->errors->toArray();
	}


}