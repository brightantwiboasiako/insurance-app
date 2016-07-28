<?php
/**
 * Created by PhpStorm.
 * User: Bright
 * Date: 17/07/2016
 * Time: 14:17
 */

namespace Aforance\Aforance\Customer\Contracts;


interface CustomerRegistrationListenerInterface
{

    /**
     * Listener method to be called if customer
     * registration is successful
     *
     * @return mixed
     */
    public function onSuccessfulRegistration();

    /**
     * Method to call if customer registration
     * is not successful
     *
     * @param $data
     * @return mixed
     */
    public function onFailedRegistration($data);

}