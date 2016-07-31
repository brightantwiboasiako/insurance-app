<?php
/**
 * Created by PhpStorm.
 * User: Bright
 * Date: 7/31/2016
 * Time: 4:48 PM
 */

namespace Aforance\Aforance\Support\Contracts;


interface BulkProcessor
{
    public function getFailed();
    public function getSuccessful();
    public function batchCount();
    public function run();
}