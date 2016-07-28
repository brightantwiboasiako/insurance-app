<?php 

namespace Aforance\Http\Controllers\Customer;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Aforance\Http\Controllers\Controller;
use Aforance\Aforance\Service\CustomerService;
use Aforance\Aforance\Customer\Contracts\CustomerRegistrationListenerInterface;


class RegistrationController extends Controller implements CustomerRegistrationListenerInterface{

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


	/**
	 * Creates a new customer
	 *
	 * @param Request $request
	 * @return mixed
	 */
	public function createCustomer(Request $request){
		return $this->service->createCustomer($request->all(), Auth::user()->role(), $this);
	}


	/**
	 * Listener method for successful registration
	 *
	 * @return mixed
	 */
	public function onSuccessfulRegistration(){
		return response()->json([ 'OK' => true ]);
	}

	/**
	 * Listener method for failed registration
	 *
	 * @param $data
	 * @return Response
	 */
	public function onFailedRegistration($data){
		return response()->json([
			'OK' => false,
			'errors' => $data['errors']
		]);
	}


}