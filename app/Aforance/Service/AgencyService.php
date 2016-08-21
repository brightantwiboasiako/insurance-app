<?php
/**
 * Created by PhpStorm.
 * User: Bright
 * Date: 8/20/16
 * Time: 8:11 PM
 */

namespace Aforance\Aforance\Service;


use Aforance\Aforance\Business\Business;
use Aforance\Aforance\Contracts\Business\Policy;
use Aforance\Aforance\Contracts\Premium;
use Aforance\Aforance\Repository\AgentRepository;
use Aforance\Aforance\Service\Contracts\ServiceInterface;
use Aforance\Aforance\Support\Permission\CanCheckPermission;

class AgencyService implements ServiceInterface
{

    use CanCheckPermission;


    /**
     * Repository of agents
     *
     * @var AgentRepository
     */
    private $agents;


    public function __construct(){
        $this->agents = app('agency.repository');
    }




}