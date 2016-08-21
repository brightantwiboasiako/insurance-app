<?php
/**
 * Created by PhpStorm.
 * User: Bright
 * Date: 8/3/2016
 * Time: 5:09 AM
 */

namespace Aforance\Aforance\Contracts;


use Money\Money;

interface Premium
{

    /**
     * The amount of the premium paid
     *
     * @return Money
     */
    public function amountPaid();

    /**
     * The amount of the premium expected
     *
     * @return mixed
     */
    public function amountExpected();


    /**
     * Gets the id of the premium
     *
     * @return mixed
     */
    public function id();

}