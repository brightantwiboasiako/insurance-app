<?php
/**
 * Created by PhpStorm.
 * User: Bright
 * Date: 7/31/2016
 * Time: 7:22 PM
 */

namespace Aforance\Aforance\Business;


use Aforance\Aforance\Contracts\Business\Policy;
use Aforance\Aforance\Repository\Contracts\PolicyRepositoryInterface;

class PolicyDocument
{

    protected $viewFile;
    
    protected $downloadFile;

    protected $repository;


    public function __construct(PolicyRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function handle($policyNumber, $action){
        if($action === 'view') return $this->display($policyNumber);
        return $this->download($policyNumber);
    }


    private function download($policyNumber){
        $policy = $this->repository->getPolicyByNumber($policyNumber);

        $maker = app('pdf');
        return $maker->displayView($this->downloadFile, compact('policy'), $policyNumber.'.pdf');
    }


    private function display($policyNumber){
        $policy = $this->repository->getPolicyByNumber($policyNumber);
        return $this->loadView($policy);
    }


    private function loadView(Policy $policy = null){
        return view($this->viewFile, ['policy' => $policy]);
    }

}