<?php
/**
 * Created by PhpStorm.
 * User: Bright
 * Date: 7/28/2016
 * Time: 10:15 AM
 */

namespace Aforance\Aforance\Support;


class FormHelper
{

    public static function defaultSelect($old, $new){
        return ($old === $new) ? 'selected' : '';
    }

}