<?php
/**
 * Created by PhpStorm.
 * User: Bright
 * Date: 8/2/2016
 * Time: 10:40 AM
 */

namespace Aforance\Aforance\Business\ChildEducation;


use Aforance\Aforance\Business\PolicyDocument;

class Document extends PolicyDocument
{
    const VIEW_FILE = 'policies.childeducation.document';
    const DOWNLOAD_FILE = 'policies.childeducation.document.download';


    public function __construct()
    {
        parent::__construct(app('childeducation.contracts.repository'));
        $this->downloadFile = static::DOWNLOAD_FILE;
        $this->viewFile = static::VIEW_FILE;
    }

}