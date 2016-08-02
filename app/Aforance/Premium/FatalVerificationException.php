<?php
/**
 * Created by PhpStorm.
 * User: Bright
 * Date: 8/2/2016
 * Time: 7:17 PM
 */

namespace Aforance\Aforance\Premium;


/**
 * Class FatalVerificationException
 *
 * This exception is thrown whenever a
 * failed premium verification must
 * prevent the creation of premium
 *
 *
 * @package Aforance\Aforance\Premium
 */
class FatalVerificationException extends \Exception
{

    public function __construct($message = '')
    {
        parent::__construct($message);
    }

}