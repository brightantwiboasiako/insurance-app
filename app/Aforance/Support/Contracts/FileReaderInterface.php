<?php
/**
 * Created by PhpStorm.
 * User: Bright
 * Date: 7/31/2016
 * Time: 3:03 PM
 */

namespace Aforance\Aforance\Support\Contracts;


interface FileReaderInterface
{

    /**
     * Reads the content of a file
     * and returns it
     *
     * @param $path
     * @return mixed
     */
    public function read($path);

}