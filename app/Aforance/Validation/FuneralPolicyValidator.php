<?php 

namespace Aforance\Aforance\Validation;

use Illuminate\Support\Collection;

class FuneralPolicyValidator extends Validator implements PolicyValidatorInterface{


	use CanCheckPolicyData;


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
		$this->setHandlers(app('funeral.validation.handlers'));
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

	public function setHandlers(array $handlers)
	{
		$this->handlers = $handlers;
	}


}