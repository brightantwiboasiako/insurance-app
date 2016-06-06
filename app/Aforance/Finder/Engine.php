<?php
/**
 * Created by PhpStorm.
 * User: Bright
 * Date: 5/15/2016
 * Time: 4:58 PM
 */

namespace Aforance\Insurance\Finder;


class Engine{

    private $query;
    private $model;
    private $by;

    public function __construct($params){
        $this->setModel($params['model']);
        $this->by = $params['by'];
        $this->query = $this->withLike($params);
    }

    public function run(){
        return (new $this->model)->where($this->by, 'like', $this->query)
            ->take(5)->get()->toJson();
    }


    private function setModel($model){
        switch($model){
            case 'customer':
                $this->model = \Aforance\Customer::class;
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
