<?php

namespace Aforance;

use Aforance\Aforance\Business\Funeral\PolicyStructure;
use Aforance\Aforance\Contracts\Business\LifePolicy;
use Aforance\Aforance\Contracts\Business\Policy;
use Aforance\Aforance\Support\Database\HasLast;
use Aforance\Aforance\Support\DateHelper;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Money\Money;

class FuneralPolicy extends Model implements LifePolicy
{

    use HasLast;

    protected $table = 'funeral_policies';
    protected $guarded = ['id'];


    public function customer(){
        return $this->belongsTo(Customer::class);
    }


    public function policyNumber()
    {
        return $this->policy_number;
    }

    public function sumAssured(){
        return Money::withSecure($this->sum_assured);
    }

    public function sumAssuredOriginal(){
        return Money::withSecure($this->sum_assured_original);
    }

    public function ageOfPrimaryInsured(){
        return (DateHelper::ageNextBirthday($this->customer->birthday()));
    }


    public function periodicPremiumString(){
        return 'PREMIUM ('.$this->payment_frequency.')';
    }

    public function policyHolderName(){
        return $this->customer->name();
    }

    /**
     * @return Customer|null
     */
    public function policyHolder(){
        return $this->customer;
    }

    public function issueDate(){
        return new Carbon($this->issue_date);
    }


    public function structure(){
        return new PolicyStructure($this);
    }


    /**
     * @param $live
     * @return Money
     */
    public function benefit($live){
        if($live === 'primary'){
            return $this->sumAssured();
        }else{
            $amount = $this->sumAssured();
            $amount->times($this->familyBenefitFactor($live));
            return $amount;
        }
    }


    /**
     * Gets the benefit amount of a family member using
     * the member's position
     *
     * @param int $key The position of the family member
     * @return Money
     */
    public function familyBenefit($key){
        $member = $this->familyMembers()[$key];
        return $this->benefit($member['relationship']);
    }


    public function familyBenefitFactor($live){
        // @TODO: Calculate this based on given percentages
        return 0.6;
    }


    public function premiumStructure(){
        return [
            'basic' => json_decode($this->periodic_premium, true),
            'underwriting' => $this->underwritingPremium()
        ];
    }

    public function underwritingPremium(){
        return Money::withSecure($this->underwriting_premium);
    }

    public function underwritingPremiumComponent(){
        return $this->premiumComponents()['underwriting'];
    }

    /**
     * @return Money
     */
    public function premium()
    {
        $premiums = $this->premiumComponents();
        $premium = $premiums['primary'];
        $premium->add($premiums['underwriting']);
        $premium->add($premiums['accidental_rider']);

        foreach($premiums['family'] as $amount){
            $premium->add($amount);
        }

        return $premium;
    }


    /**
     * Returns an array of all premium components
     *
     * @return array
     */
    protected function premiumComponents(){
        $premiumService = app('premium');
        return $premiumService->getPremium('funeral', $this);
    }


    public function accidentalPremiumComponent(){
        return $this->premiumComponents()['accidental_rider'];
    }

    public function premiumFrequency()
    {
        return $this->paymentFrequency();
    }


    /**
     * @param $live
     * @param null $familyKey
     * @return mixed
     */
    public function premiumFor($live, $familyKey = null){
        if($live === 'primary'){
            return $this->premiumComponents()['primary'];
        }else{ // family premiums
             if($familyKey === null){
                 return $this->premiumComponents()['family'];
             }else{
                 return $this->premiumComponents()['family'][$familyKey];
             }
        }
    }

    /**
     * @param $age
     * @param $live
     * @return Carbon
     */
    public function expiry($age, $live){
        // @TODO Change this algorithm to use real calculation
        return Carbon::now()->addYear();
    }

    public function bank(){
        return json_decode($this->bank, true);
    }

    public function bankName(){
        return (isset($this->bank()['name'])) ? $this->bank()['name'] : null;
    }


    public function bankAccountNumber(){
        return (isset($this->bank()['account_number'])) ? $this->bank()['account_number'] : null;
    }

    public function accidentalRiderPremium(){
        return Money::withSecure($this->accidental_rider_premium);
    }

    public function accidentalRider(){
        return $this->accidental_rider;
    }

    public function familyRider(){
        return $this->family_rider;
    }

    public function familyMembers(){
        if($this->family_members == null)
            return [];
        else
            return json_decode($this->family_members, true);
    }

    public function paymentMode(){
        return $this->mode_of_payment;
    }

    public function paymentFrequency(){
        return $this->payment_frequency;
    }

    /**
     * Saves a policy in the database and
     * returns it
     *
     * @param array $data
     * @return Policy
     */
    public static function issue(array $data){
        $policy = new static();
        $policy->setSumAssured($data['policy_details']['sum_assured']);
        $policy->setSumAssuredOriginal($data['policy_details']['sum_assured']);
        $policy->setPolicyNumber($data['policy_number']);
        $policy->setAccidentalRider($data['policy_details']['accidental_rider']);
        $policy->setAccidentalRiderPremium($data['policy_details']['accidental_rider_premium']);
        $policy->setBank($data['policy_details']['bank']);
        $policy->setBeneficiaries($data['beneficiaries']);
        $policy->setPaymentFrequency($data['policy_details']['payment_frequency']);
        $policy->setPaymentMode($data['policy_details']['mode_of_payment']);
        $policy->setOriginalAccidentalRiderPremium($data['policy_details']['accidental_rider_premium']);
        $policy->setAgentId($data['agent_id']);
        $policy->setAutomaticUpdatePercentage($data['policy_details']['automatic_update_percentage']);
        $policy->setBranchId($data['branch_id']);
        $policy->setCapturedBy($data['captured_by']);
        $policy->setCustomerId($data['customer_id']);
        $policy->setIssueDate($data['policy_details']['issue_date']);
        $policy->setTrustee($data['trustee']);
        $policy->setUnderwriting($data['underwriting']);
        $policy->setPeriodicPremium($data['premium']);
        $policy->setFamilyMembers($data['policy_details']['family']);
        $policy->save();

        return $policy;
    }


    public function setSumAssured($amount){
        $this->sum_assured = Money::withRaw($amount)->getSecure();
    }

    private function setSumAssuredOriginal($amount){
        $this->sum_assured_original = Money::withRaw($amount)->getSecure();
    }

    private function setPolicyNumber($number){
        $this->policy_number = $number;
    }

    public function setPaymentFrequency($frequency){
        $this->payment_frequency = $frequency;
    }

    public function setPeriodicPremium($premium){
        $this->periodic_premium = json_encode($premium);
    }

    public function setPaymentMode($mode){
        $this->mode_of_payment = $mode;
    }

    public function setAccidentalRider($rider){
        $this->accidental_rider = $rider;
    }

    public function setAccidentalRiderPremium($premium){
        $this->accidental_rider_premium = Money::withRaw($premium)->getSecure();
    }

    public function setOriginalAccidentalRiderPremium($premium){
        $this->original_accidental_rider_premium = Money::withRaw($premium)->getSecure();
    }

    public function setBeneficiaries($beneficiaries){
        $this->beneficiaries = json_encode($beneficiaries, true);
    }

    public function setBank($bank){
        $this->bank = json_encode($bank, true);
    }

    public function setFamilyMembers($members){
        $this->family_members = json_encode($members, true);
    }

    public function setFamilyRider($rider){
        $this->family_rider = $rider;
    }

    private function setCustomerId($id){
        $this->customer_id = $id;
    }

    public function setAutomaticUpdatePercentage($percentage){
        $this->automatic_update_percentage = $percentage;
    }

    public function setUnderwriting($underwriting){
        $this->underwriting = json_encode($underwriting, true);
    }

    private function setIssueDate($date){
        $this->issue_date = (new Carbon($date))->format('Y-m-d H:i:s');
    }

    public function setBranchId($id){
        $this->branch_id = $id;
    }

    public function setAgentId($id){
        $this->agent_id = $id;
    }

    public function setTrustee($trustee){
        $this->trustee = json_encode($trustee, true);
    }

    private function setCapturedBy($id){
        $this->captured_by = $id;
    }

}
