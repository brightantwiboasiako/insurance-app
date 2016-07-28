<?php
/**
 * Created by PhpStorm.
 * User: Bright
 * Date: 7/28/2016
 * Time: 11:20 AM
 */

namespace Aforance\Aforance\Contracts\Business;


interface DocumentRenderer
{
    /**
     * Renders a document
     * 
     * @param $policyNumber
     * @return mixed
     */
    public function renderDocument($policyNumber);

}