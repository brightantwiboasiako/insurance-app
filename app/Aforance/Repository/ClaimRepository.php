<?php 

namespace Aforance\Aforance\Repository;

use Aforance\Customer;
use Aforance\PolicyType;
use Illuminate\Support\Facades\DB;

class ClaimRepository{

    public function clients($query){
    	$query=$query->input('name');
    	$customers=DB::table('customers')
                        ->where('surname',$query)
                        ->orWhere('first_name',$query)
                        ->orWhere('other_name',$query)
                        ->get();
            
            return $data=['query'=>$query , 'customers'=>$customers ];

    }

    public function policies(Customer $customer ){
    	
    	$motors= DB::table('motor_policies')->where('motor_policies.customer_id',$customer->id)->get();
    	$funerals= DB::table('funeral_policies')->where('funeral_policies.customer_id',$customer->id)->get();
    	$lifes= DB::table('life_policies')->where('life_policies.customer_id',$customer->id)->get();

    	return $data=['motors'=>$motors,'funerals'=>$funerals,'lifes'=>$lifes,'customer'=>$customer];

    }

    public function register($request){
		$exist=DB::table('claims')->where('policy_number',$request->policy_number)
								->where('policy_type',$request->identifier)->count();
    	if ($exist>0) {
    		return "This claim is already registered";
    	}
	
		$user=\Auth::user();
		$register=DB::table('claims')->insert(['policy_number'=>$request->policy_number, 'policy_type'=>$request->identifier, 'amount'=>$request->sum_assured, 'status'=>$request->status, 'captured_by'=>$user->id, 'created_at'=>\Carbon\Carbon::now()]);
		if ($register) {
			return "claim registered!";
    		}
    }

    public function payClaim()
    {
    	$policyType=PolicyType::get();
    	$claims=DB::table('claims')->get();
    	return $data=['policyType'=>$policyType , 'claims'=>$claims];
    }

    public function updateClaim($request)
    {
    	DB::table('claims')->where('id',$request->id)
    						->update(['status'=>$request->status]);
    }

    public function viewClaim()
    {
        $policyType=PolicyType::get();
        $claims=DB::table('claims')->get();
        return $data=['policyType'=>$policyType , 'claims'=>$claims];
    }
}

