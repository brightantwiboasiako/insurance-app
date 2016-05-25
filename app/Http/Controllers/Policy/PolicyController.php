<?php
/**
 * Created by PhpStorm.
 * User: Bright
 * Date: 5/22/2016
 * Time: 3:14 PM
 */

namespace App\Http\Controllers\Policy;


use App\Http\Controllers\Controller;
use App\PaymentFrequency;
use App\PaymentMethod;
use App\PolicyType;
use Illuminate\Http\Request;

class PolicyController extends Controller
{

    public function getMetadata(Request $request){

        $type = e($request->input('type'));


        $policyType = PolicyType::getByIndentifier($type);

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

        return json_encode($response, true);

    }

}