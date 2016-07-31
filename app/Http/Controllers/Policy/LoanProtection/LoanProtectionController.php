<?php

namespace Aforance\Http\Controllers\Policy\LoanProtection;


use Aforance\Aforance\Policy\PolicyActionListenerInterface;
use Aforance\Aforance\Service\PolicyService;
use Aforance\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoanProtectionController extends Controller implements PolicyActionListenerInterface
{

    const BUSINESS_TYPE = 'loan protection';


    private $action;


    private $role;

    /**
     * @var Request
     */
    private $request;

    /**
     * @var PolicyService
     */
    private $service;
    
    public function __construct(PolicyService $service)
    {
        $this->service = $service;
        $this->role = Auth::user()->role();
    }

    public function index(){
        return view('policies.loanprotection.index');
    }

    public function getViewScreen($policyNumber){
        $this->action = 'view policy';
        return $this->service->getPolicyByNumber(static::BUSINESS_TYPE, e($policyNumber), $this->role, $this);
    }


    public function addBorrowers(Request $request, $policyNumber){
        // set action and request for appropriate handling of callback

        $this->action = 'add borrower';
        $this->request = $request;
        return $this->service->business(static::BUSINESS_TYPE)->addBorrower($request->all(),
            e($policyNumber), $this, $this->role);
    }


    public function onSuccessfulAction($action, $data)
    {
        return $this->actionProcessor($action, $data);
    }

    public function onFailedAction($action, $data)
    {
        return $this->actionProcessor($action, $data, false);
    }

    /**
     * Processes an action response returned by
     * the policy service
     *
     * @param $action
     * @param $data
     * @param bool $success
     * @return mixed
     */
    private function actionProcessor($action, $data, $success = true){
        switch($action){
            case 'view policy':
                return $this->viewPolicyCallback($data, $success);
            case 'add borrower':
                return $this->addBorrowerCallback($data, $success);
        }
    }


    protected function addBorrowerCallback(array $data, $success){
        if($this->request->ajax()){
            if($success)
                return response()->json([ 'OK' => true ]);
            return response()->json(array_merge($data, ['OK' => false]));
        }

        // handle for non-ajax requests
    }


    /**
     * @param array $data
     * @param $success
     * @return mixed
     */
    protected function viewPolicyCallback(array $data, $success){
        if($success){
            $policy = $data['policy'];
            return view('policies.loanprotection.view', compact('policy'));
        }else{
            // failed permission
            if($data['reason'] === 'permission')
                return abort(403, 'You are forbidden from doing this!');
            else
                return abort(404);
        }
    }

    /**
     * @return string
     */
    public function getAction(){
        return $this->action;
    }

}