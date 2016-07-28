<?php 

namespace Aforance\Aforance\Service;

use Aforance\Aforance\Premium\Calculators\PremiumCalculatorInterface;
use Aforance\Aforance\Service\Contracts\ServiceInterface;


class PremiumService implements ServiceInterface{


	/**
	* Gets the first premium of a given business
	*
	* @param string $businessType
	* @param array $data
	*
	* @return Money
	*/
	public function getFirstPremium($businessType, array $data){
		$calculator = $this->makeCalculator($businessType);
		return $calculator->firstPremium($data);
	}


	/**
	* Gets the premium for an existing premium
	*
	* @param string $businessType
	* @param int $policyId
	*
	* @return Money
	*/
	public function getPremiumAmount($businessType, $policyId){


	}


	/**
	* Makes a premium calculator for the premium service
	*
	* @param string $businessType
	*
	* @return PremiumCalculatorInterface
	*/
	private function makeCalculator($businessType){
		$calculator = null;
		switch($businessType){
			default: 
				$calculator = app('funeral.calculator');
		}
		return $calculator;
	}

}