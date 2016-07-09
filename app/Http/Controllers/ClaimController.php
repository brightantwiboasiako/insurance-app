<?php

namespace Aforance\Http\Controllers;

use Aforance\Customer;
use Aforance\Http\Requests;
use Aforance\PolicyType;
use Aforance\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Aforance\Aforance\Service\ClaimService;

class ClaimController extends Controller
{
	private $service;

	public function __construct(ClaimService $service)
	{
		$this->service = $service;
	}


	public function index()
	{
    		return view('claim.register');
	}

	public function detail()
	{
    		return view('claim.details');
	}

    public function clients(Request $request){
        $data=$this->service->customers($request);
        
        return view('claim.register', $data);
    }

    public function policies(Customer $customer ){
    	$data=$this->service->policies($customer);

    	return view('claim.policies', $data);
    }

    public function register(Request $request){

    	return $this->service->register($request);
    }

    public function payClaim()
    {
    	$data=$this->service->payment();
    	return view('claim.claims', $data);
    }

    public function updateClaim(Request $request)
    {
    	$this->service->update($request);

    	return redirect('/claim/payment'); 
    }

    public function view()
    {
    	$data=$this->service->view();
    	return view('claim.view', $data);
    }
}
