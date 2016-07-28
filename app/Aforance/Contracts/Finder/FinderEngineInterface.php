<?php
/**
 * Created by PhpStorm.
 * User: Bright
 * Date: 7/23/2016
 * Time: 10:58 AM
 */

namespace Aforance\Aforance\Contracts\Finder;


interface FinderEngineInterface
{
    /**
     * Runs the finder engine
     *
     * @return mixed
     */
    public function run();

    /**
     * Sets the parameters of the engine
     *
     * @param array $params
     * @return FinderEngineInterface
     */
    public function params(array $params);
}