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
use Illuminate\Support\Facades\Auth;

class PolicyCreationController extends Controller implements PolicyCreationListenerInterface
{

    /**
     * Policy service for handling policy services
     *
     * @var PolicyService
     */
    private $service;

    public function __construct(PolicyService $service)
    {
        $this->service = $service;
    }


    public function issue(Request $request){
        return $this->service->issuePolicy(
            array_merge($request->all(), ['captured_by' => Auth::user()->id])
            , Auth::user()->role(), $this);
    }

    public function onSuccessfulCreation()
    {
        return response()->json(['OK' => true]);
    }

    public function onFailedCreation($data)
    {
        return response()->json(array_merge(['OK' => false], $data));
    }


}