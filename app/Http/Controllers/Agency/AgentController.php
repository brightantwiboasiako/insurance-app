<?php
/**
 * Created by PhpStorm.
 * User: Bright
 * Date: 7/25/2016
 * Time: 8:01 AM
 */

namespace Aforance\Http\Controllers\Agency;


use Aforance\Aforance\Repository\Contracts\AgentRepositoryInterface;
use Aforance\Http\Controllers\Controller;

class AgentController extends Controller
{

    /**
     * @var AgentRepositoryInterface
     */
    private $agents;
    
    public function __construct(AgentRepositoryInterface $agents)
    {
        $this->agents = $agents;
    }

    public function all(){
        return $this->agents->activeAgents();
    }
    
}