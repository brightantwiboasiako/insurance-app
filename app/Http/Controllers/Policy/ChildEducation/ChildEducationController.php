<?php
/**
 * Created by PhpStorm.
 * User: Bright
 * Date: 8/1/2016
 * Time: 11:30 AM
 */

namespace Aforance\Http\Controllers\Policy\ChildEducation;


use Aforance\Aforance\Policy\PolicyActionListenerInterface;
use Aforance\Aforance\Repository\CustomerRepository;
use Aforance\Aforance\Service\PolicyService;
use Aforance\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ChildEducationController extends Controller implements PolicyActionListenerInterface
{
    /**
     * @var CustomerRepository
     */
    private $customers;


    /**
     * Instance of the policy service
     *
     * @var PolicyService
     */
    private $service;


    /**
     * This indicates which action is
     * being requested from the policy service
     *
     * @var string
     */
    private $action;


    public function __construct(CustomerRepository $customers, PolicyService $service)
    {
        $this->customers = $customers;
        $this->service = $service;
    }


    public function index(){
        return view('policies.childeducation.index');
    }

    public function getCreationScreen($customerId){
        return view('policies.childeducation.create', ['customer' => $this->customers->findOrFail(e($customerId))]);
    }


    public function getViewScreen($policyNumber){
        $this->action = 'view';
        return $this->service->getPolicyByNumber('childeducation', e($policyNumber), Auth::user()->role(), $this);
    }

    public function onSuccessfulAction($action, $data)
    {
        switch($action){
            case 'view':
                return view('policies.childeducation.view', ['policy' => $data['policy']]);
        }
    }

    public function onFailedAction($action, $data)
    {
        dd($data);
    }

    public function getAction()
    {
        return $this->action;
    }


}