<?php
/**
 * Created by PhpStorm.
 * User: Bright
 * Date: 7/28/2016
 * Time: 11:08 AM
 */

namespace Aforance\Http\Controllers\Policy;


use Aforance\Aforance\Service\PolicyService;
use Aforance\Http\Controllers\Controller;

class PolicyDocumentController extends Controller
{

    private $service;

    public function __construct(PolicyService $service)
    {
        $this->service = $service;
    }

    public function showDocument($business, $policyNumber){
        return $this->service->policyDocument($business, $policyNumber, 'view');
    }

    public function downloadDocument($business, $policyNumber){
        return $this->service->policyDocument($business, $policyNumber, 'download');
    }

}