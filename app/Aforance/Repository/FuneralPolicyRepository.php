<?php 

namespace Aforance\Aforance\Repository;

use Aforance\Aforance\Contracts\Repository\FuneralPolicyRepositoryInterface;
use Aforance\FuneralPolicy;

class FuneralPolicyRepository implements FuneralPolicyRepositoryInterface{

	/**
	 * Stores funeral policy data to persistence
	 * data source
	 *
	 * @param array $data
	 */
	public function create(array $data){
		FuneralPolicy::issue($data);
	}

	/**
	 * @param $policyNumber
	 * @return FuneralPolicy|null
	 */
	public function getByPolicyNumber($policyNumber)
	{
		return FuneralPolicy::where('policy_number', $policyNumber)->first();
	}

}