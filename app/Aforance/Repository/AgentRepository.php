<?php
/**
 * Created by PhpStorm.
 * User: Bright
 * Date: 7/25/2016
 * Time: 8:13 AM
 */

namespace Aforance\Aforance\Repository;


use Aforance\Aforance\Repository\Contracts\AgentRepositoryInterface;
use Aforance\Agent;

class AgentRepository implements AgentRepositoryInterface
{

    public function activeAgents(){
        return Agent::where('status', 1)->get();
    }

    public function find($id){
        return Agent::findOrFail($id);
    }

}