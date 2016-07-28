<?php
/**
 * Created by PhpStorm.
 * User: Bright
 * Date: 7/27/2016
 * Time: 5:03 PM
 */

namespace Aforance\Aforance\Support;


use Carbon\Carbon;

class DateHelper
{

    /**
     * Calculates the age at next birthday
     *
     * @param $birthday
     * @return int
     */
    public static function ageNextBirthday($birthday){
        $date = new Carbon($birthday);
        $now = Carbon::now();
        $years = $now->diffInYears($date);

        if($date->month <= $now->month) $years += 1;

        return $years;
    }

}