<?php
/**
 * Created by PhpStorm.
 * User: Bright
 * Date: 7/29/2016
 * Time: 3:41 PM
 */

namespace Aforance;


use Aforance\Aforance\Business\LoanProtection\Borrower;
use Aforance\Aforance\Contracts\Business\Policy;
use Aforance\Aforance\Support\Database\HasLast;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Money\Money;

class LoanProtectionPolicy extends Model implements Policy
{

    use HasLast;

    protected $table = 'loanprotection';

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
    public function borrowers(){
        return ($this->policyBorrowers === null) ? new Collection : $this->policyBorrowers;
    }


    /**
     * Adds a borrower to the loan protection
     * plan
     *
     * @param array $details
     * @return $this
     */
    public function addBorrower(array $details){
        $this->policyBorrowers->push(new Borrower($details));
        return $this;
    }


    /**
     * Adds multiple borrowers to the plan
     *
     * @param array $borrowers
     */
    public function addAll(array $borrowers){
        foreach($borrowers as $key => $borrower){
            $this->addBorrower($borrowers);
        }
    }


    /**
     * Removes a borrower from the plan
     *
     * @param $key
     * @return $this
     */
    public function removeBorrower($key){
        $this->policyBorrowers->pull($key);
        $this->setBorrowers($this->policyBorrowers->toArray());
        $this->save([
            'borrowers' => $this->borrowers()->toJson()
        ]);
        return $this;
    }


    /**
     * Stores a new loan protection plan in
     * database and returns it
     *
     * @param array $data
     * @return Policy
     */
    public static function issue(array $data){

        // Check and set premium and borrowers appropriately
        $data['premium'] = isset($data['premium']) ? $data['premium'] : 0;
        $data['borrowers'] = isset($data['borrowers']) ? $data['borrowers'] : [];

        $policy = new static();
        $policy->setInstitutionAddress($data['financier']['address']);
        $policy->setInstitutionName($data['financier']['name']);
        $policy->setInstitutionEmail($data['financier']['email']);
        $policy->setInstitutionPhone($data['financier']['phone']);
        $policy->setInstitutionBranch($data['financier']['branch']);
        $policy->setPremium($data['premium']);
        $policy->setBorrowers($data['borrowers']);
        $policy->setPolicyNumber($data['policy_number']);

        $policy->save();

        return $policy;
    }

    public function setInstitutionName($name){
        $this->institution_name = $name;
    }

    public function setInstitutionEmail($email){
        $this->institution_email = $email;
    }

    public function setInstitutionAddress($address){
        $this->institution_address = $address;
    }

    public function setInstitutionPhone($number){
        $this->institution_phone = $number;
    }
    
    public function setInstitutionBranch($branch){
        $this->institution_branch = $branch;
    }

    public function setPremium($amount){
        $this->premium = Money::withRaw($amount)->getSecure();
    }

    public function setBorrowers(array $borrowers){
        $this->addAll($borrowers);
        $this->borrowers = $this->borrowers()->toJson();
    }

    public function setPolicyNumber($number){
        $this->policy_number = $number;
    }

}