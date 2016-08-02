<?php
/**
 * Created by PhpStorm.
 * User: Bright
 * Date: 8/1/2016
 * Time: 11:30 AM
 */

namespace Aforance\Http\Controllers\Policy\ChildEducation;


use Aforance\Aforance\Repository\CustomerRepository;
use Aforance\Aforance\Service\PolicyService;
use Aforance\Http\Controllers\Controller;

class ChildEducationController extends Controller
{
    /**
     * @var CustomerRepository
     */
    private $customers;


    public function __construct(CustomerRepository $customers)
    {
        $this->customers = $customers;
    }


    public function index(){
        return view('policies.childeducation.index');
    }

    public function getCreationScreen($customerId){
        return view('policies.childeducation.create', ['customer' => $this->customers->findOrFail(e($customerId))]);
    }

}