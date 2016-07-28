<?php
/**
 * Created by PhpStorm.
 * User: Bright
 * Date: 5/22/2016
 * Time: 3:14 PM
 */

namespace Aforance\Http\Controllers\Policy;


use Aforance\Aforance\Policy\PolicyCreationListenerInterface;
use Aforance\Aforance\Service\PolicyService;
use Aforance\Http\Controllers\Controller;
use Aforance\PolicyType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PolicyController extends Controller
{

    public function getMetadata(Request $request){

        $type = e($request->input('type'));
        $policyType = PolicyType::getByIdentifier($type);

        $response = [];

        if($policyType){
            $data = [
                'title' => $policyType->title,
                'identifier' => $policyType->identifier,
                'options' => $policyType->options
            ];

            $response['OK'] = true;
            $response['data'] = $data;
        }else{
            $response['OK'] = false;
        }

        return response()->json($response);

    }

}