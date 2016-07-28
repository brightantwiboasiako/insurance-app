<?php

namespace Aforance\Http\Controllers\Policy\LoanProtection;


use Aforance\Http\Controllers\Controller;

class LoanProtectionController extends Controller
{

    public function index(){
        return view('policies.loanprotection.index');
    }

}