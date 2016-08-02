<?php
/**
 * Created by PhpStorm.
 * User: Bright
 * Date: 5/15/2016
 * Time: 4:58 PM
 */

namespace Aforance\Aforance\Finder;


use Aforance\Aforance\Contracts\Finder\FinderEngineInterface;
use Aforance\ChildEducationPolicy;
use Aforance\Customer;
use Aforance\FuneralPolicy;
use Aforance\LoanProtectionPolicy;

class EloquentEngine implements FinderEngineInterface{

    private $query;
    private $model;
    private $by;

    public function __construct($params = null){
        if(is_array($params) && count($params) > 0){
            $this->params($params);
        }
    }

    /**
     * Runs the finder engine
     *
     * @return mixed
     */
    public function run(){
        return (new $this->model)->where($this->by, 'like', $this->query)
            ->take(5)->get()->toJson();
    }

    /**
     * @param array $params
     * @return $this
     */
    public function params(array $params)
    {
        $this->setModel($params['model']);
        $this->by = $params['by'];
        $this->query = $this->withLike($params);
        return $this;
    }

    private function setModel($model){
        switch($model){
            case 'customer':
                $this->model = Customer::class;
                break;
            case 'funeral':
                $this->model = FuneralPolicy::class;
                break;
            case 'childeducation':
                $this->model = ChildEducationPolicy::class;
                break;
            case 'loanprotection':
                $this->model = LoanProtectionPolicy::class;
                break;
        }
    }


    private function withLike($params){
        $query = $params['query'];
        if(!isset($params['like'])){
            return '%'.$query.'%';
        }else if($params['like'] < 0){
            return '%'.$query;
        }else{
            return $query.'%';
        }
    }

}
