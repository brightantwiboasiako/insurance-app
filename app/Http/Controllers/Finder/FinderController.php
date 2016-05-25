<?php
/**
 * Created by PhpStorm.
 * User: Bright
 * Date: 5/15/2016
 * Time: 5:18 PM
 */

namespace App\Http\Controllers\Finder;


use App\Http\Controllers\Controller;
use App\Insurance\Finder\Engine;
use Illuminate\Http\Request;

class FinderController extends Controller{


    public function execute(Request $request){

        $params = [
            'model' => e($request->input('model')),
            'by' => e($request->input('by')),
            'query' => e($request->input('query')),
            'like' => $request->has('like') ? e($request->input('like')) : null
        ];

        $engine = new Engine($params);

        return $engine->run();

    }

}