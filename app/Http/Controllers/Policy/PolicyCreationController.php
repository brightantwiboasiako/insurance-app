<?php
/**
 * Created by PhpStorm.
 * User: Bright
 * Date: 17/07/2016
 * Time: 18:26
 */

namespace Aforance\Http\Controllers\Policy;


use Aforance\Aforance\Policy\PolicyCreationListenerInterface;
use Aforance\Aforance\Service\PolicyService;
use Aforance\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PolicyCreationController extends Controller implements PolicyCreationListenerInterface
{

    /**
     * Policy service for handling policy services
     *
     * @var PolicyService
     */
    private $service;

    public function issuePolicy(Request $request){
        return $this->service->issuePolicy($request->all(), Auth::user()->role, $this);
    }

    public function onSuccessfulCreation()
    {
        // TODO: Implement onSuccessfulCreation() method.
    }


    public function onFailedCreation($data)
    {
        // TODO: Implement onFailedCreation() method.
    }

}