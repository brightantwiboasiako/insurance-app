<?php
/**
 * Created by PhpStorm.
 * User: Bright
 * Date: 7/28/2016
 * Time: 11:27 AM
 */

namespace Aforance\Aforance\Business\Funeral;

use Barryvdh\Snappy\Facades\SnappyPdf as PDF;
use Aforance\Aforance\Contracts\Business\Policy;
use Aforance\Aforance\Contracts\Repository\FuneralPolicyRepositoryInterface;

class Document
{

    const VIEW_FILE = 'policies.funeral.document';
    const DOWNLOAD_FILE = 'policies.funeral.document.download';

    /**
     * @var FuneralPolicyRepositoryInterface
     */
    private $repository;

    public function __construct()
    {
        $this->repository = app('funeral.repository_contract');
    }

    public function handle($policyNumber, $action){
        if($action === 'view') return $this->display($policyNumber);
        return $this->download($policyNumber);
    }


    private function download($policyNumber){
        $policy = $this->repository->getPolicyByNumber($policyNumber);
        
        $maker = app('pdf');
        return $maker->displayView(static::DOWNLOAD_FILE, compact('policy'), $policyNumber.'.pdf');
    }


    private function display($policyNumber){
        $policy = $this->repository->getPolicyByNumber($policyNumber);
        return $this->loadView($policy);
    }


    private function loadView(Policy $policy = null){
        return view(static::VIEW_FILE, ['policy' => $policy]);
    }

}