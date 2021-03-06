<?php
/**
 * Created by PhpStorm.
 * User: Bright
 * Date: 7/28/2016
 * Time: 11:27 AM
 */

namespace Aforance\Aforance\Business\Funeral;

use Aforance\Aforance\Business\PolicyDocument;

class Document extends PolicyDocument
{

    const VIEW_FILE = 'policies.funeral.document';
    const DOWNLOAD_FILE = 'policies.funeral.document.download';


    public function __construct()
    {
        parent::__construct(app('funeral.repository_contract'));
        $this->viewFile = static::VIEW_FILE;
        $this->downloadFile = static::DOWNLOAD_FILE;
    }


}