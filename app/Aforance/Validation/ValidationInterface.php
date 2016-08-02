<?php 

namespace Aforance\Aforance\Validation;

interface ValidationInterface{

	/**
	 * Checks if the validation has passed
	 *
	 * @return mixed
	 */
	public function passes();

	/**
	 * Checks if the validation has failed
	 *
	 * @return mixed
	 */
	public function fails();

	/**
	 * Gets validation errors, if any
	 *
	 * @return mixed
	 */
	public function errors();

	/**
	 * Checks the given data against registered
	 * handlers
	 *
	 * @param array $data
	 * @return mixed
	 */
	public function check(array $data);

	/**
	 * Sets the handlers.
	 * This will clear existing handlers
	 *
	 * @param array $handlers
	 * @return mixed
	 */
	public function setHandlers(array $handlers);

}