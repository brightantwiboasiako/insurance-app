<?php
/**
 * Created by PhpStorm.
 * User: Bright
 * Date: 5/15/2016
 * Time: 5:18 PM
 */

namespace Aforance\Http\Controllers\Finder;


use Aforance\Aforance\Contracts\Finder\FinderEngineInterface;
use Aforance\Http\Controllers\Controller;
use Aforance\Aforance\Finder\Engine;
use Illuminate\Http\Request;

class FinderController extends Controller{

    /**
     * @var FinderEngineInterface
     */
    private $engine;
    
    public function __construct(FinderEngineInterface $engine){
        $this->engine = $engine;
    }

    public function execute(Request $request){
        return $this->engine->params([
            'model' => e($request->input('model')),
            'by' => e($request->input('by')),
            'query' => e($request->input('query')),
            'like' => $request->has('like') ? e($request->input('like')) : null
        ])->run();
    }

}