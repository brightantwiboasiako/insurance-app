<?php
/**
 * Created by PhpStorm.
 * User: Bright
 * Date: 8/2/2016
 * Time: 7:10 PM
 */

namespace Aforance\Aforance\Premium;


use Aforance\Premium;

class PremiumRepository
{

    public function create(array $data){
        return Premium::record($data);
    }

}