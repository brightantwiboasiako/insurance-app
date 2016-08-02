<?php 

namespace Aforance\Aforance\Service;

use Aforance\Aforance\Contracts\Business\Policy;
use Aforance\Aforance\Service\Contracts\ServiceInterface;
use Aforance\Aforance\Premium\Calculators\PremiumCalculatorInterface;
class PremiumService implements ServiceInterface{


	/**
	* Gets the first premium of a given business
	*
	* @param string $businessType
	* @param array $data
	*
	* @return mixed
	*/
	public function getFirstPremium($businessType, array $data){
		$calculator = $this->makeCalculator($businessType);
		return $calculator->firstPremium($data);
	}


	/**
	* Gets the premium for an existing premium
	*
	* @param string $businessType
	* @param Policy $policy
	*
	* @return mixed
	*/
	public function getPremium($businessType, Policy $policy){
		return $this->makeCalculator($businessType)->getPremium($policy);
	}


	/**
	* Makes a premium calculator for the premium service
	*
	* @param string $businessType
	*
	* @return PremiumCalculatorInterface
	*/
	private function makeCalculator($businessType){
		return app($businessType.'.calculator');
	}

}