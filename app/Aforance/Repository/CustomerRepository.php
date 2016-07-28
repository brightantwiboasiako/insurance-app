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


    /**
     * @param $id
     * @return Customer|null
     */
    public function find($id){
        return Customer::find($id);
    }


    /**
     * @param $id
     * @return Customer|null
     */
    public function findOrFail($id){
        return Customer::findOrFail($id);
    }

}

