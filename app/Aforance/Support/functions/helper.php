<?php
/**
 * Created by PhpStorm.
 * User: Bright
 * Date: 7/28/2016
 * Time: 10:20 AM
 */


if(!function_exists('default_select')){

    function default_select($old, $new){
        return \Aforance\Aforance\Support\FormHelper::defaultSelect(strtolower($old), strtolower($new));
    }

}