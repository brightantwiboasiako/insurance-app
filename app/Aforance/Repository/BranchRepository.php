<?php
/**
 * Created by PhpStorm.
 * User: Bright
 * Date: 7/25/2016
 * Time: 8:37 AM
 */

namespace Aforance\Aforance\Repository;


use Aforance\Branch;

class BranchRepository
{

    public function all(){
        return Branch::all();
    }
    
}