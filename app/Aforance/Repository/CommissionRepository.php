<?php
/**
 * Created by PhpStorm.
 * User: Bright
 * Date: 8/20/16
 * Time: 10:25 PM
 */

namespace Aforance\Aforance\Repository;


use Aforance\Commission;

class CommissionRepository
{

    public function create(array $data){
        return Commission::create($data);
    }

}