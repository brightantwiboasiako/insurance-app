<?php
/**
 * Created by PhpStorm.
 * User: Bright
 * Date: 7/29/2016
 * Time: 12:07 AM
 */

namespace Aforance\Aforance\Support\Contracts;


interface PDFMaker
{
    /**
     * Downloads the generated pdf file
     * and saves it using the provided filename
     *
     * @param string $view
     * @param array $data
     * @param $filename
     * @return mixed
     */
    public function downloadView($view, $data = [], $filename = null);

    /**
     * Displays the generated pdf in the
     * browser
     *
     * @param string $view
     * @param array $data
     * @param null $filename
     * @return mixed
     */
    public function displayView($view, $data = [], $filename = null);
}