<?php
/**
 * Created by PhpStorm.
 * User: Bright
 * Date: 7/29/2016
 * Time: 3:41 PM
 */

namespace Aforance;


use Aforance\Aforance\Business\LoanProtection\Borrower;
use Aforance\Aforance\Business\LoanProtection\BorrowersPaginator;
use Aforance\Aforance\Contracts\Business\Policy;
use Aforance\Aforance\Support\Database\HasLast;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Money\Money;

class LoanProtectionPolicy extends Model implements Policy
{

    use HasLast;

    protected $table = 'loan_protection_policies';

    protected $guarded = ['id'];

    /**
     * A collection of all borrowers objects
     *
     * @var Collection
     */
    private $policyBorrowers;



    public function policyNumber()
    {
        return $this->policy_number;
    }

    public function premiumStructure()
    {
        // TODO: Implement premiumStructure() method.
    }

    public function premiumFrequency()
    {
        return 1;
    }

    /**
     * Gets all the borrowers under the plan
     *
     * @return Collection
     */
    public function loanBorrowers(){

        $borrowers = new Collection;
        $data = json_decode($this->borrowers, true);

        foreach($data as $borrower){
            $borrowers->push(new Borrower($borrower));
        }

        return $borrowers;
    }


    /**
     * Gets the total loan amount for the policy
     *
     * @return Money
     */
    public function totalLoanAmount(){
        $borrowers = $this->loanBorrowers();
        $amount = new Money(0);

        $borrowers->each(function($borrower) use ($amount){
            $amount->add($borrower->loanAmount());
        });

        return $amount;
    }


    /**
     * Gets the premium amount under the policy
     *
     * @return Money
     */
    public function premium(){
        $borrowers = $this->loanBorrowers();
        $amount = new Money(0);

        $borrowers->each(function($borrower) use ($amount){
            $amount->add($borrower->premium());
        });

        return $amount;
    }


    public function issueDate(){
        return new Carbon($this->created_at);
    }


    /**
     * Adds borrowers to the loan protection
     * plan
     *
     * @param array $borrowers
     * @return bool
     */
    public function addBorrowers(array $borrowers){

        // add all to borrowers and save
        $this->setBorrowers($borrowers);
        return $this->save();
    }


    /**
     * Removes a borrower from the plan
     *
     * @param $key
     * @return $this
     */
    public function removeBorrower($key){
        //
    }


    public function institutionName(){
        return $this->institution_name;
    }

    public function institutionEmail(){
        return $this->institution_email;
    }

    public function institutionAddress(){
        return $this->institution_address;
    }

    public function institutionPhone(){
        return $this->institution_phone;
    }

    public function institutionBranch(){
        return $this->institution_branch;
    }


    /**
     * Stores a new loan protection plan in
     * database and returns it
     *
     * @param array $data
     * @return Policy
     */
    public static function issue(array $data){

        // Check and set borrowers appropriately
        $data['borrowers'] = isset($data['borrowers']) ? $data['borrowers'] : [];

        $policy = new static();
        $policy->setInstitutionAddress($data['financier']['address']);
        $policy->setInstitutionName($data['financier']['name']);
        $policy->setInstitutionEmail($data['financier']['email']);
        $policy->setInstitutionPhone($data['financier']['phone']);
        $policy->setInstitutionBranch($data['financier']['branch']);
        $policy->setBorrowers($data['borrowers']);
        $policy->setPolicyNumber($data['policy_number']);

        $policy->save();

        return $policy;
    }

    private function setInstitutionName($name){
        $this->institution_name = $name;
    }

    private function setInstitutionEmail($email){
        $this->institution_email = $email;
    }

    private function setInstitutionAddress($address){
        $this->institution_address = $address;
    }

    private function setInstitutionPhone($number){
        $this->institution_phone = $number;
    }
    
    private function setInstitutionBranch($branch){
        $this->institution_branch = $branch;
    }

    private function setBorrowers(array $borrowers){

        if($this->borrowers === null || empty(json_decode($this->borrowers, true))){
            $data = [];
        }else{
            $data = json_decode($this->borrowers, true);
        }

        // first time
        foreach($borrowers as $borrower){
            $b = new Borrower($borrower);
            $data[] = $this->extractBorrowerInfo($b);
        }

        $this->borrowers = json_encode($data, true);
    }

    private function extractBorrowerInfo(Borrower $borrower){

        return [
            'loan_amount' => $borrower->loanAmount()->getAmount(),
            'term' => $borrower->loanTerm(),
            'issue_date' => $borrower->loanIssueDate()->format('Y-m-d'),
            'premium' => $borrower->premium()->getAmount(),
            'name' => $borrower->name(),
            'gender' => $borrower->gender(),
            'phone' => $borrower->phone(),
            'birthday' => $borrower->birthday()->format('Y-m-d')
        ];
    }

    private function setPolicyNumber($number){
        $this->policy_number = $number;
    }

}