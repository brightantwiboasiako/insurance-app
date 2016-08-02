<?php 

namespace Aforance\Aforance\Validation;

use Illuminate\Support\Collection;

class Validator implements ValidationInterface{

	/**
	 * This is the underlying validator engine
	 *
	 * @var \Illuminate\Validation\Validator
	 */
	protected $validator;


	/**
	 * All validation handlers for checking data
	 *
	 * @var array
	 */
	protected $handlers = [];


	/**
	 * All validation errors to be sent to client
	 * after all validation handlers are run.
	 *
	 * @var Collection
	 */
	protected $errors;


	public function __construct()
	{
		$this->errors = new Collection;
	}


	/**
	 * Runs the validation engine
	 *
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


	/**
	 * Gets the errors returned by the validation engine (Laravel)
	 * per each run of \Validator::make
	 *
	 * @return \Illuminate\Support\MessageBag
	 */
	public function engineErrors(){
		return $this->validator->errors();
	}


	/**
	 * Checks if the validator has passed
	 *
	 * @return bool
	 */
	public function passes(){
		return $this->validator->passes();
	}


	/**
	 * Checks if the validator has failed.
	 *
	 * @return bool
	 */
	public function  fails(){
		return $this->validator->fails();
	}


	/**
	 * Gets all validation errors after
	 * all registered handlers are run
	 *
	 * @return array
	 */
	public function errors()
	{
		return $this->errors->toArray();
	}

	/**
	 * Checks the given data against all registered
	 * handlers
	 *
	 * @param array $data
	 * @return void
	 * @throws ValidationException
	 */
	public function check(array $data)
	{
		// Run all registered validation handlers
		foreach($this->handlers as $handler){
			$handler->handle($data, $this, $this->errors);
		}

		// Throw an exception if there are errors
		// This will help client know when to pull errors
		if(!$this->errors->isEmpty()) throw new ValidationException;
	}


	/**
	 * Sets the validation handlers for
	 * validation
	 *
	 * @param array $handlers
	 * @return void
	 */
	public function setHandlers(array $handlers)
	{
		$this->handlers = $handlers;
	}


}