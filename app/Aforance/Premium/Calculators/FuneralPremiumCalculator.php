<?php

namespace Aforance\Aforance\Premium\Calculators;

use Aforance\Aforance\Contracts\Business\FuneralPremiumLoader;
use Aforance\Aforance\Contracts\Business\Policy;
use Aforance\Aforance\Support\DateHelper;
use Aforance\FuneralPolicy;
use Money\Money;

class FuneralPremiumCalculator implements PremiumCalculatorInterface{

	const PREMIUM_FREQUENCY_MONTHLY = 'MONTHLY';
	const PREMIUM_FREQUENCY_QUARTERLY = 'QUARTERLY';
	const PREMIUM_FREQUENCY_SEMI_ANNUALLY = 'SEMI ANNUALLY';
	const PREMIUM_FREQUENCY_ANNUALLY = 'ANNUALLY';
	const BASE_SUM_ASSURED = 1000.00;

	/**
	 * The funeral premium rates
	 *
	 * @var array
	 */
	private $rates = [];


	private $factor;


	public function __construct(FuneralPremiumLoader $loader){
		$this->rates = $loader->loadRates();
	}


	public function getPremium(Policy $policy){
		$premiumStructure = $policy->premiumStructure();
		$this->setFactor($policy->premiumFrequency());

		return [
			'primary' => $this->convertCoverPremium($premiumStructure['basic']['primary'], $policy->sumAssured()),
			'family' => $this->buildFamilyPremium($premiumStructure['basic']['family'], $policy),
			'underwriting' => $this->convert($premiumStructure['underwriting']->getAmount()),
			'accidental_rider' => $this->convert($policy->accidentalRiderPremium()->getAmount())
		];

	}


	private function buildFamilyPremium(array $family, $policy){
		$premiums = [];
		foreach($family as $key => $amount){
			$premiums[$key] = $this->convertCoverPremium((float)$amount, $policy->familyBenefit($key));
		}

		return $premiums;
	}


	private function convertCoverPremium($amount, Money $sumAssured){
		return $this->convert(((float)$amount) * $this->factor * ($sumAssured->getAmount()/static::BASE_SUM_ASSURED));
	}

	private function convert($amount){
		return Money::withRaw(((float)$amount) * $this->factor);
	}

	private function setFactor($frequency){
		switch ($frequency){
			case static::PREMIUM_FREQUENCY_ANNUALLY:
				$this->factor = 12;
				break;
			case static::PREMIUM_FREQUENCY_QUARTERLY:
				$this->factor = 3;
				break;
			case static::PREMIUM_FREQUENCY_SEMI_ANNUALLY:
				$this->factor = 6;
				break;
			default: // monthly
				$this->factor = 1;
		}
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