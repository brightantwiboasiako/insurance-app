<?php
/**
 * Created by PhpStorm.
 * User: Bright
 * Date: 17/07/2016
 * Time: 17:21
 */

namespace Aforance\Aforance\Support\Permission;


trait CanCheckPermission
{

    /**
     * Checks if provided role is permitted
     * to take the given action
     *
     * @param $action
     * @param $role
     * @return bool
     */
    public function isPermittedTo($action, $role){
        try{
            return $this->checker->role($role)->action($action)->allowed();
        }catch(UnauthorizedActivityException $e){
            return false;
        }
    }
    
}