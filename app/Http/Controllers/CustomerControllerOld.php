<?php

namespace Aforance\Http\Controllers;

use Aforance\Customer;
use Aforance\Events\CustomerCreated;
use Carbon\Carbon;
use Illuminate\Http\Request;

use Aforance\Http\Requests;
use Illuminate\Support\Facades\Validator;

class CustomerControllerOld extends Controller{


    private function validator(Request $request, $id = null){



        return Validator::make($request->all(), [
            'title' => 'required',
            'surname' => 'required|max:64',
            'first_name' => 'required|max:32',
            'other_name' => 'max:32',
            'email' => 'required|email|unique:customers,email,'.$id,
            'primary_phone_number' => 'required|max:15',
            'personal_address' => 'required|max:1024',
            'gender' => 'required',
            'birth_day' => 'required',
            'occupation' => 'required|max:128',
            'employer_name' => 'required|max:64',
            'employer_address' => 'required|max:1024'
        ]);
    }


    public function edit(Request $request){

        $validator = $this->validator($request, e($request->input('id')));

        $response = [];

        if($validator->fails()){
            $response['OK'] = false;
            $response['errors'] = $validator->errors();
        }else{
            // update customer

            $data = [
                'title' => e($request->input('title')),
                'surname' => e($request->input('surname')),
                'first_name' => e($request->input('first_name')),
                'last_name' => e($request->input('last_name')),
                'other_name' => e($request->input('other_name')),
                'email' => e($request->input('email')),
                'primary_phone_number' => e($request->input('primary_phone_number')),
                'occupation' => e($request->input('occupation')),
                'employer_name' => e($request->input('employer_name')),
                'employer_address' => e($request->input('employer_address')),
                'personal_address' => e($request->input('personal_address'))
            ];

            $customer = Customer::find(e($request->input('id')));

            if($customer){
                $customer->update($data);
                $response['OK'] = true;
            }else{
                $response['OK'] = false;
                $response['message'] = 'Customer not found!';
            }
        }

        return $response;

    }



    public function create(Request $request){

        $validator = $this->validator($request);

        $response = [];

        if($validator->fails()){
            $response['OK'] = false;
            $response['errors'] = $validator->errors();
        }else{
            // create customer

            $data = $request->all();

            foreach($data as &$value){
                e($value);
            }

            $data['birth_day'] = (new Carbon($data['birth_day']))->format('Y-m-d');
            $data['created_by'] = \Auth::id();

            $customer = Customer::create($data);

            event(new CustomerCreated($customer));

            $response['OK'] = true;
        }


        return $response;

    }

}
