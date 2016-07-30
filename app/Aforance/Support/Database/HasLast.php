<?php
/**
 * Created by PhpStorm.
 * User: Bright
 * Date: 7/30/2016
 * Time: 7:28 AM
 */

namespace Aforance\Aforance\Support\Database;


trait HasLast
{

    public static function last(){
        return static::orderBy('id', 'DESC')->first();
    }
    
}