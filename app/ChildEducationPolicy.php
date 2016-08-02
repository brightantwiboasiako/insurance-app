<?php

namespace Aforance;

use Aforance\Aforance\Business\ChildEducation\Child;
use Aforance\Aforance\Contracts\Business\InvestmentLinked;
use Aforance\Aforance\Contracts\Business\LifePolicy;
use Illuminate\Database\Eloquent\Model;
use Money\Money;

class ChildEducationPolicy extends Model implements LifePolicy, InvestmentLinked
{
    protected $table = 'child_education_policies';
    protected $guarded = ['id'];

    public function policyNumber()
    {
        return $this->policy_number;
    }

    public function sumAssured()
    {
        return Money::withSecure($this->sum_assured);
    }

    public function premiumStructure()
    {
        return $this->premium;
    }

    public function premiumFrequency()
    {
        return $this->premium_frequency;
    }

    
    public function investmentYieldRate(){
        return $this->investment_yield_rate / 100;
    }
    

    /**
     * Gets the children covered by the policy
     */
    public function children(){

        $children = [];
        $raw = json_decode($this->children, true);

        foreach($raw as $key => $details){
            $children[$key] = new Child($details);
        }

        return $children;
    }


    public static function issue(array $data){
        
        $policy = new static();
        $policy->setSumAssured($data['policy_details']['sum_assured']);
        $policy->setChildren($data['children']);
        $policy->setPremium($data['premium']);
        $policy->setUnderwriting($data['underwriting']);
        $policy->setTrustee($data);
        $policy->setPaymentFrequency($data['policy_details']['payment_frequency']);
        $policy->setPaymentMode($data['policy_details']['mode_of_payment']);
        $policy->setCustomerId($data['customer_id']);
        $policy->setPolicyNumber($data['policy_number']);

        $policy->save();

        return $policy;
    }


    private function setPolicyNumber($policyNumber){
        $this->policy_number = $policyNumber;
    }

    private function setUnderwriting($underwriting){
        $this->underwriting = json_encode($underwriting, true);
    }


    private function setCustomerId($id){
        $this->customer_id = $id;
    }

    private function setPaymentFrequency($frequency){
        $this->payment_frequency = $frequency;
    }

    private function setPaymentMode($mode){
        $this->mode_of_payment = $mode;
    }

    private function setSumAssured($amount){
        $this->sum_assured = Money::withRaw($amount)->getSecure();
    }


    private function setChildren(array $children){

        if($this->children == null || empty(json_decode($this->children, true))){
            $data = [];
            $lastId = 0;
        }else{
            $data = json_decode($this->children, true);
            $lastId = end($data)['id'];
        }

        // Assign incrementing (unique) ids to every child
        foreach($children as $key => $child){
            $children[$key]['id'] = ++$lastId;
        }

        $this->children = json_encode(array_merge($data, $children), true);

    }

    private function setPremium($amount){
        $this->premium = Money::withRaw($amount)->getSecure();
    }

    private function setTrustee(array $data){
        $this->trustee = (isset($data['trustee'])) ? json_encode($data['trustee'], true) : json_encode([], true);
    }

}
