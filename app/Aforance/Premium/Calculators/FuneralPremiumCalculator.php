<?php

namespace Aforance\Aforance\Premium\Calculators;

use Aforance\Aforance\Contracts\Business\Policy;
use Aforance\Aforance\Contracts\Business\PremiumLoader;
use Aforance\Aforance\Support\DateHelper;

class FuneralPremiumCalculator extends PeriodicPremiumCalculator{

	/**
	 * The funeral premium rates
	 *
	 * @var array
	 */
	private $rates = [];


	public function __construct(PremiumLoader $loader){
		$this->rates = $loader->loadRates();
	}


	/**
	 * Gets the premium definition of a funeral policy
	 *
	 * @param Policy $policy
	 * @return array
	 */
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


	/**
	 * Builds the premiums for all family members
	 * under the funeral policy
	 *
	 * @param array $family
	 * @param $policy
	 * @return array
	 */
	private function buildFamilyPremium(array $family, $policy){
		$premiums = [];
		foreach($family as $key => $amount){
			$premiums[$key] = $this->convertCoverPremium((float)$amount, $policy->familyBenefit($key));
		}
		return $premiums;
	}

	/**
	 * Gets the first premium definition for a
	 * funeral policy.
	 * All funeral premiums are stored using assuming a
	 * monthly payment frequency
	 *
	 * @param $data
	 * @return array
	 */
	public function firstPremium($data){
		// Get premium rates and handle first
		// premium calculations for funeral policies

		return [
			'primary' => $this->getRate($data['age'], 'primary', $this->rates),
			'family' => $this->familyPremiumRates($data['policy_details']['family'])
		];
	}


	/**
	 * Gets the premium rates for family members
	 *
	 * @param $family
	 * @return array
	 */
	private function familyPremiumRates($family){
		$rates = [];
		foreach($family as $key => $member){
			$live = $member['relationship'];
			$rates[$key] = $this->getRate(DateHelper::ageNextBirthday($member['birthday']), $live, $this->rates);
		}
		return $rates;
	}

}