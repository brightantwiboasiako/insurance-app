<?php
/**
 * Created by PhpStorm.
 * User: Bright
 * Date: 5/22/2016
 * Time: 12:26 PM
 */

namespace Aforance\Http\Controllers\Policy\Funeral;


use Aforance\Aforance\Contracts\Repository\FuneralPolicyRepositoryInterface;
use Aforance\Aforance\Repository\CustomerRepository;
use Aforance\Http\Controllers\Controller;

class FuneralController extends Controller
{

    /**
     * @var CustomerRepository
     */
    private $customers;


    /**
     * @var FuneralPolicyRepositoryInterface
     */
    private $policies;

    public function __construct(CustomerRepository $customers)
    {
        $this->customers = $customers;
        $this->policies = app('funeral.repository_contract');
    }


    public function index(){
        return view('policies.funeral.index');
    }


    /**
     * Gets the form for creating new funeral
     * policies
     *
     * @param $customerId
     * @return mixed
     */
    public function getCreationScreen($customerId){
        return view('policies.funeral.create', ['customer' => $this->customers->findOrFail(e($customerId))]);
    }


    public function getViewScreen($policyNumber){
        $policy = $this->policies->getPolicyByNumber(e($policyNumber));
        if($policy)
            return view('policies.funeral.view', ['policy' => $policy]);
        else
            return abort(404);
    }

}