<?php
/**
 * Created by PhpStorm.
 * User: Bright
 * Date: 7/31/2016
 * Time: 7:15 PM
 */

namespace Aforance\Aforance\Business\LoanProtection;


use Aforance\Aforance\Business\PolicyDocument;

class Document extends PolicyDocument
{

    const VIEW_FILE = 'policies.loanprotection.document';
    const DOWNLOAD_FILE = 'policies.loanprotection.document.download';


    public function __construct()
    {
        parent::__construct(app('loanprotection.repository_contract'));
        $this->viewFile = static::VIEW_FILE;
        $this->downloadFile = static::DOWNLOAD_FILE;
    }

}