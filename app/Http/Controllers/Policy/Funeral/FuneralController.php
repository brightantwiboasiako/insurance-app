<?php
/**
 * Created by PhpStorm.
 * User: Bright
 * Date: 5/22/2016
 * Time: 12:26 PM
 */

namespace App\Http\Controllers\Policy\Funeral;


use App\Http\Controllers\Controller;

class FuneralController extends Controller
{

    public function index(){
        return view('policies.funeral.index');
    }

}