<?php
/**
 * Created by PhpStorm.
 * User: Bright
 * Date: 7/28/2016
 * Time: 11:27 AM
 */

namespace Aforance\Aforance\Business\Funeral;


use Aforance\Aforance\Contracts\Business\Policy;
use Aforance\Aforance\Contracts\Repository\FuneralPolicyRepositoryInterface;

class Document
{

    const VIEW_FILE = 'policies.funeral.document';

    /**
     * @var FuneralPolicyRepositoryInterface
     */
    private $repository;

    public function __construct()
    {
        $this->repository = app('funeral.repository_contract');
    }

    public function display($policyNumber){
        $policy = $this->repository->getByPolicyNumber($policyNumber);
        return $this->loadView($policy);
    }


    private function loadView(Policy $policy = null){
        return view(static::VIEW_FILE, ['policy' => $policy]);
    }

}