<?php
/**
 * Created by PhpStorm.
 * User: Bright
 * Date: 8/1/2016
 * Time: 2:42 AM
 */

namespace Aforance\Aforance\Business\ChildEducation;


use Carbon\Carbon;

class Child
{

    private $details = [];

    public function __construct(array $details)
    {
        $this->details = $details;
    }


    public function name(){
        return $this->get('name');
    }

    public function birthday(){
        return new Carbon($this->get('birthday'));
    }

    public function percentage(){
        return $this->get('percentage');
    }


    public function id(){
        return $this->get('id');
    }

    private function get($key){
        return isset($this->details[$key]) ? $this->details[$key] : null;
    }

}