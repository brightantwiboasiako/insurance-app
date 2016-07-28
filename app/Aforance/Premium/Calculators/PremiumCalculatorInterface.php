<?php

namespace Aforance\Aforance\Premium\Calculators;

use Aforance\Aforance\Contracts\Business\Policy;

interface PremiumCalculatorInterface{

	public function firstPremium($data);
	public function getPremium(Policy $policy);
	
}