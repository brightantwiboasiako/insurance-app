<?php
/**
 * Created by PhpStorm.
 * User: Bright
 * Date: 17/07/2016
 * Time: 18:31
 */

namespace Aforance\Aforance\Policy;

interface PolicyActionListenerInterface
{

    public function onSuccessfulAction($action, $data);
    public function onFailedAction($action, $data);
    public function getAction();

}