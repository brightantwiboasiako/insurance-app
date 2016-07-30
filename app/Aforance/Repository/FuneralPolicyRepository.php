<?php 

namespace Aforance\Aforance\Repository;

use Aforance\Aforance\Contracts\Business\Policy;
use Aforance\Aforance\Contracts\Repository\FuneralPolicyRepositoryInterface;
use Aforance\FuneralPolicy;

class FuneralPolicyRepository implements FuneralPolicyRepositoryInterface{

	/**
	 * Stores funeral policy data to persistence
	 * data source
	 *
	 * @param array $data
	 * @return Policy
	 */
	public function create(array $data){
		return FuneralPolicy::issue($data);
	}

	/**
	 * @param $policyNumber
	 * @return FuneralPolicy|null
	 */
	public function getPolicyByNumber($policyNumber)
	{
		return FuneralPolicy::where('policy_number', $policyNumber)->first();
	}

	public function last(){
		return FuneralPolicy::last();
	}

}