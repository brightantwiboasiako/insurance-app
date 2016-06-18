<?php 

namespace Aforance\Http\Controllers;

use Aforance\Customer;
use Illuminate\Http\Request;
use Aforance\Aforance\Service\CustomerService;
use Aforance\Aforance\Validation\ValidationException;


class CustomerController extends Controller{

	/**
	* A customer service
	*
	* @var CustomerService	
	*
	*/
	private $service;


	public function __construct(CustomerService $service){
		$this->service = $service;
	}


	public function createCustomer(Request $request){

		$response = [
			'OK' => true
		];

		try {
			
			$this->service->createCustomer($request->all());

		} catch (ValidationException $e) {
			$response['OK'] = false;
            $response['errors'] = $this->service->errors();
		}


		return $response;

	}


}