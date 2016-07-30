<?php
/**
 * Created by PhpStorm.
 * User: Bright
 * Date: 7/29/2016
 * Time: 7:03 AM
 */

namespace Aforance\Aforance\Support;


use Aforance\Aforance\Support\Contracts\PDFMaker;

class DOMPDF implements PDFMaker
{

    private $renderer;

    public function __construct()
    {
        $this->renderer = app('dompdf.wrapper');
    }

    public function downloadView($view, $data = [], $filename = 'policy_document.pdf')
    {
        return $this->renderer->loadView($view, $data)->download($filename);
    }

    public function displayView($view, $data = [], $filename = 'policy_document.pdf')
    {
        return $this->renderer->loadView($view, $data)->stream($filename);
    }


}