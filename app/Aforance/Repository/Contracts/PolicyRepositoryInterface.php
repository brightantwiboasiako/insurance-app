<?php 

namespace Aforance\Aforance\Repository\Contracts;

use Aforance\Aforance\Contracts\Business\Policy;

interface PolicyRepositoryInterface{

	/**
	 * Adds a policy to the repository
	 *
	 * @param array $data
	 * @return Policy
	 */
	public function create(array $data);

	/**
	 * Gets the last policy in the repository
	 *
	 * @return Policy
	 */
	public function last();


	/**
	 * Gets a policy by the policy number
	 *
	 * @param string $policyNumber
	 * @return Policy
	 */
	public function getPolicyByNumber($policyNumber);
	
}