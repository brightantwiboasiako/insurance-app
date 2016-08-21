<?php

namespace Aforance;

use Money\Money;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Aforance\Aforance\Contracts\Premium as PremiumContract;

class Premium extends Model implements PremiumContract
{

    protected $table = 'premiums';
    protected $guarded = ['id'];




    /**
     * Records a new premium in the
     * database and returns it.
     *
     * @param array $data
     * @return Premium
     */
    public static function record(array $data){
        $premium = new static();

        $premium->setBusinessType($data['business_type']);
        $premium->setAmountExpected($data['amount_expected']);
        $premium->setAmountPaid($data['amount_paid']);
        $premium->setCapturedBy($data['captured_by']);
        $premium->setChequeNumber($data['cheque_number']);
        $premium->setIsComplete($data['is_complete']);
        $premium->setPeriod($data['period']);
        $premium->setPolicyNumber($data['policy_number']);
        $premium->setReceiptCode($data['receipt_code']);
        $premium->setReceivedAt($data['received_at']);

        $premium->save();

        return $premium;
    }


    // Getters
    public function businessType(){
        return $this->business_type;
    }

    public function amountExpected(){
        return Money::withSecure($this->amount_expected);
    }

    public function amountPaid(){
        return Money::withSecure($this->amount_paid);
    }

    public function id(){
        return $this->id;
    }

    public function policyNumber(){
        return $this->policy_number;
    }

    public function period(){
        return (new Carbon($this->period));
    }

    public function isComplete(){
        return $this->is_complete;
    }

    public function chequeNumber(){
        return $this->check_number;
    }

    public function receiptCode(){
        return $this->receipt_code;
    }

    public function receivedAt(){
        return new Carbon($this->received_at);
    }

    public function capturedBy(){
        return $this->captured_by;
    }


    // Setters
    private function setBusinessType($business){
        $this->business_type = $business;
    }

    private function setAmountExpected($amount){
        $this->amount_expected = Money::withRaw($amount)->getSecure();
    }

    private function setAmountPaid($amount){
        $this->amount_paid = Money::withRaw($amount)->getSecure();
    }

    private function setPolicyNumber($number){
        $this->policy_number = $number;
    }

    private function setPeriod($period){
        $monthStart = (new Carbon($period))->startOfMonth();
        $this->period = $monthStart->format('Y-m-d');
    }

    private function setIsComplete($isComplete){
        $this->is_complete = $isComplete;
    }

    private function setChequeNumber($number = null){
        $this->check_number = $number;
    }

    private function setReceiptCode($code){
        $this->receipt_code = $code;
    }

    private function setReceivedAt($date){
        $this->received_at = (new Carbon($date))->format('Y-m-d');
    }

    private function setCapturedBy($capturedBy){
        $this->captured_by = $capturedBy;
    }

}
