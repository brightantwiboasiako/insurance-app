<?php
/**
 * Created by PhpStorm.
 * User: Bright
 * Date: 7/30/2016
 * Time: 3:41 PM
 */

namespace Aforance\Aforance\Policy;


interface PolicyCreationListenerInterface
{
    public function onSuccessfulCreation(array $data = []);
    public function onFailedCreation($data);
}