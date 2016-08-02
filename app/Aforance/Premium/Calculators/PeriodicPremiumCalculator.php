<?php
/**
 * Created by PhpStorm.
 * User: Bright
 * Date: 8/1/2016
 * Time: 10:18 AM
 */

namespace Aforance\Aforance\Premium\Calculators;

use Money\Money;

abstract  class PeriodicPremiumCalculator implements PremiumCalculatorInterface
{
    const PREMIUM_FREQUENCY_MONTHLY = 'MONTHLY';
    const PREMIUM_FREQUENCY_QUARTERLY = 'QUARTERLY';
    const PREMIUM_FREQUENCY_SEMI_ANNUALLY = 'SEMI ANNUALLY';
    const PREMIUM_FREQUENCY_ANNUALLY = 'ANNUALLY';
    const BASE_SUM_ASSURED = 1000.00;


    /**
     * The premium factor loading based on
     * the payment frequency of the policy
     *
     * @var int
     */
    protected $factor = 1;


    /**
     * Sets the premium factor using the
     * payment frequency
     *
     * @param $frequency
     * @return void
     */
    protected function setFactor($frequency){
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


    /**
     * Converts an amount weighting it by
     * the sum assured and premium factor
     * 
     * @param $amount
     * @param Money $sumAssured
     * @return Money
     */
    protected function convertCoverPremium($amount, Money $sumAssured){
        return $this->convert(((float)$amount) * $this->factor * ($sumAssured->getAmount()/static::BASE_SUM_ASSURED));
    }


    /**
     * Converts an amount based on the premium factor
     * using the premium frequency
     * 
     * @param $amount
     * @return Money
     */
    protected function convert($amount){
        return Money::withRaw(((float)$amount) * $this->factor);
    }


    /**
     * Gets the next multiple of five or
     * returns given age if already multiple
     * of five
     *
     * @param int $age
     * @return int
     */
    protected function toNearestPlusFive($age){
        if($age % 5 === 0) return $age; // Already a multiple of five
        return $age + (5 - ($age % 5));
    }

    /**
     * Gets the premium rate for a given live based on age,
     * field and rates.
     *
     * NOTE: rates are passed because not all periodic
     * premium calculations involve rates
     *
     * @param int $age
     * @param string $field
     * @param array $rates
     * @return float
     */
    public function getRate($age, $field, array $rates){
        $roundedAge = $this->toNearestPlusFive($age);
        $rateCategory = array_filter($rates, function($rate) use ($roundedAge){
            return $rate['age_limit'] === $roundedAge;
        });

        if(count($rateCategory)){
            return array_values($rateCategory)[0][$field];
        }else{
            return 0.0;
        }
    }

}