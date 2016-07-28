<?php

namespace Aforance\Aforance\Premium\Calculators;

use Aforance\Aforance\Contracts\Business\FuneralPremiumLoader;
use Aforance\Aforance\Support\DateHelper;

class FuneralPremiumCalculator implements PremiumCalculatorInterface{


	/**
	 * The funeral premium rates
	 *
	 * @var array
	 */
	private $rates = [];


	public function __construct(FuneralPremiumLoader $loader){
		$this->rates = $loader->loadRates();
	}

	public function firstPremium($data){
		// get premium rates and handle first
		// premium calculations for funeral policies

		return [
			'primary' => $this->getRate($data['age'], 'primary'),
			'family' => $this->familyPremiumRates($data['policy_details']['family'])
		];
	}


	/**
	 * Gets the premium rates for family members
	 *
	 * @param $family
	 * @return array
	 */
	public function familyPremiumRates($family){
		$rates = [];
		foreach($family as $key => $member){
			$live = $member['relationship'];
			$rates[$key] = $this->getRate(DateHelper::ageNextBirthday($member['birthday']), $live);
		}
		return $rates;
	}



	/**
	 * Gets the premium rate for a given live based on age
	 *
	 * @param $age
	 * @param $live
	 * @return float
	 */
	private function getRate($age, $live){
		$roundedAge = $this->toNearestPlusFive($age);
		$rateCategory = array_filter($this->rates, function($rate) use ($roundedAge){
			return $rate['age_limit'] === $roundedAge;
		});
		
		if(count($rateCategory)){
			return array_values($rateCategory)[0][$live];
		}else{
			return 0.0;
		}
	}


	/**
	 * Gets the next multiple of five or
	 * returns given age if already multiple
	 * of five
	 *
	 * @param int $age
	 * @return int
	 */
	private function toNearestPlusFive($age){
		if($age % 5 === 0) return $age; // Already a multiple of five
		return $age + (5 - ($age % 5));
	}

}