<?php
/**
 * Created by PhpStorm.
 * User: Bright
 * Date: 7/29/2016
 * Time: 5:07 PM
 */

namespace Aforance\Aforance\Business\LoanProtection;


use Carbon\Carbon;
use Money\Money;

class Borrower implements \JsonSerializable
{

    private $details;

    public function __construct($details = [])
    {
        $this->details = $details;
    }

    public function loanAmount(){
        return Money::withSecure($this->get('loan_amount'));
    }

    public function premium(){
        return Money::withSecure($this->get('premium'));
    }

    public function loanIssueDate(){
        return new Carbon($this->get('issue_date'));
    }

    public function loanTerm(){
        return $this->get('loan_term');
    }

    public function loanMaturityDate(){
        return $this->loanIssueDate()->addYears($this->loanTerm());
    }

    public function gender(){
        return $this->get('gender');
    }

    public function name(){
        return $this->get('name');
    }

    public function address(){
        return $this->get('address');
    }

    public function phone(){
        return $this->get('phone');
    }

    private function get($key){
        return isset($this->details[$key]) ? $this->details[$key] : null;
    }

    public function jsonSerialize()
    {
        return $this->details;
    }
}