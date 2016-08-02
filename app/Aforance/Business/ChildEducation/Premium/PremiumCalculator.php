<?php
/**
 * Created by PhpStorm.
 * User: Bright
 * Date: 8/1/2016
 * Time: 3:03 AM
 */

namespace Aforance\Aforance\Business\ChildEducation\Premium;


use Aforance\Aforance\Contracts\Business\Policy;
use Aforance\Aforance\Contracts\Business\PremiumLoader;
use Aforance\Aforance\Premium\Calculators\PeriodicPremiumCalculator;
use Aforance\Aforance\Support\DateHelper;

class PremiumCalculator extends PeriodicPremiumCalculator
{

    /**
     * The premium rates for child education
     * policies
     *
     * @var array
     */
    private $rates = [];


    /**
     * PremiumCalculator constructor.
     * Creates a new calculator instance
     *
     * @param PremiumLoader $loader
     */
    public function __construct(PremiumLoader $loader)
    {
        $this->rates = $loader->loadRates();
    }


    /**
     * Gets the first premium of a child protection policy
     * 
     * @param $data
     * @return float
     */
    public function firstPremium($data)
    {
        return (float)$this->getRate($data['age'], 'amount', $this->rates);
    }


    /**
     * Gets the premium amount of the child education policy
     * based on the policy's payment frequency
     *
     * @param Policy $policy
     * @return \Money\Money
     */
    public function getPremium(Policy $policy)
    {
        return $this->convertCoverPremium($policy->premiumStructure(), $policy->sunAssured());
    }


}