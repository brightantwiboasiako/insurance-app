<?php
/**
 * Created by PhpStorm.
 * User: Bright
 * Date: 7/28/2016
 * Time: 2:36 PM
 */

namespace Aforance\Aforance\Business\Funeral;


use Aforance\Aforance\Support\DateHelper;
use Aforance\FuneralPolicy;
use Money\Money;

class PolicyStructure
{
    /**
     * @var FuneralPolicy
     */
    private $policy;

    public function __construct(FuneralPolicy $policy){
        $this->policy = $policy;
    }

    public function primary(){
        $holder = $this->policy->policyHolder();
        $age = DateHelper::age($holder->birthday());
        return [
            'name' => $holder->name(),
            'benefit' => $this->policy->sumAssured(),
            'age' => $age,
            'gender' => $holder->gender(),
            'relationship' => 'Primary Insured',
            'expiry_date' => $this->policy->expiry($age, 'primary'),
            'premium' => $this->policy->premiumFor('primary')
        ];
    }
    
    public function family(){
        $family  = [];
        $members = $this->policy->familyMembers();
        foreach($members as $key => $member){
            $age = DateHelper::age($member['birthday']);
            $family[$key] = array_merge($member, [
                'age' => $age,
                'expiry_date' => $this->policy->expiry($age, $member['relationship']),
                'premium' => $this->policy->premiumFor($member['relationship'], $key),
                'benefit' => $this->policy->benefit($member['relationship'])
            ]);
        }

        return $family;
    }

    public function all(){
        $all = [$this->primary()];
        foreach($this->family() as $family){
            $all[] = $family;
        }

        return $all;
    }

    public function totalBenefit(){
        return $this->getTotal('benefit');
    }


    public function totalCoverPremium(){
        return $this->getTotal('premium');
    }

    private function getTotal($kind){
        $total = Money::withSecure(0);
        foreach($this->all() as $cover){
            $total->add($cover[$kind]);
        }
        return $total;
    }

}