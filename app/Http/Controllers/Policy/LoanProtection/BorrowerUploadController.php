<?php
/**
 * Created by PhpStorm.
 * User: Bright
 * Date: 7/31/2016
 * Time: 2:36 PM
 */

namespace Aforance\Http\Controllers\Policy\LoanProtection;


use Aforance\Aforance\Policy\PolicyActionListenerInterface;
use Aforance\Aforance\Service\PolicyService;
use Aforance\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BorrowerUploadController extends Controller implements PolicyActionListenerInterface
{

    /**
     * @var PolicyService
     */
    private $service;


    private $action;


    public function __construct(PolicyService $service)
    {
        $this->service = $service;
    }

    public function upload(Request $request, $policyNumber){

        $this->action = 'bulk upload';
        if(!$request->hasFile('loans')){
            return $this->onFailedAction('bulk upload', [
                'reason' => 'validation'
            ]);
        }

        $business = $this->service->business('loan protection');
        $include = $request->has('include_first') ? e($request->input('include_first')) : null;
        return $business->addUploadedBorrowers($policyNumber, $request->file('loans'), $include, $this);

    }

    public function onSuccessfulAction($action, $data)
    {
        dd($data);
    }

    public function onFailedAction($action, $data)
    {
        dd($data);
    }

    public function getAction()
    {
        // TODO: Implement getAction() method.
    }


}