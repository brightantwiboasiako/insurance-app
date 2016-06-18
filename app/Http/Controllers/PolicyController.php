<?php

namespace Aforance\Http\Controllers;

use Illuminate\Http\Request;

use Aforance\Http\Requests;

use Aforance\Aforance\Service\PolicyService;

class PolicyController extends Controller
{
    
	/**
	*
	* @var PolicyService
	*/
    private $service;

	public function __construct(PolicyService $service){
		$this->service = $service;
	}


	public function createPolicy(Request $request){

		$this->service->issuePolicy($request->all());

	}


}
