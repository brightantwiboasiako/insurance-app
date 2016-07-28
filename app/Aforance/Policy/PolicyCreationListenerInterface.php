<?php
/**
 * Created by PhpStorm.
 * User: Bright
 * Date: 17/07/2016
 * Time: 18:31
 */

namespace Aforance\Aforance\Policy;


interface PolicyCreationListenerInterface
{
    public function onSuccessfulCreation();
    public function onFailedCreation($data);

}