<?php
/**
 * Created by PhpStorm.
 * User: Bright
 * Date: 8/3/2016
 * Time: 5:08 AM
 */

namespace Aforance\Aforance\Contracts;


interface ReceiptCodeGeneratorInterface
{

    /**
     * Makes a receipt code for a new premium
     * payment
     *
     * @param Premium $premium
     * @return mixed
     */
    public function makeCode(Premium $premium);

}