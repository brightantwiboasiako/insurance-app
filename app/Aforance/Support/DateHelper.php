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
        $years = static::yearsFrom($birthday);
        if(static::dayAndMonthPassed($birthday)) $years += 1;
        return $years;
    }

    public static function age($birthday){
        $years = static::yearsFrom($birthday);
        if(static::dayAndMonthPassed($birthday)) $years -= 1;
        return $years;
    }

    private static function dayAndMonthPassed($date){
        $date = new Carbon($date);
        $now = Carbon::now();
        return $date->month <= $now->month && $date->day <= $now->day;
    }
    
    public static function yearsFrom($date){
        $date = new Carbon($date);
        $now = Carbon::now();
        return $now->diffInYears($date);
    }

}