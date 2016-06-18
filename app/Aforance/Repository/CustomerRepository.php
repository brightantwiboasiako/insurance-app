<?php 

namespace Aforance\Aforance\Repository;

use Carbon\Carbon;
use Aforance\Customer;

class CustomerRepository{

	public function register($data){

		foreach($data as &$value){
            e($value);
        }

		$data['birth_day'] = (new Carbon($data['birth_day']))->format('Y-m-d');
        $data['created_by'] = \Auth::id();

        return Customer::create($data);

	}
}

