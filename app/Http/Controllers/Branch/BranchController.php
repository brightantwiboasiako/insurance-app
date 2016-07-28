<?php
/**
 * Created by PhpStorm.
 * User: Bright
 * Date: 7/25/2016
 * Time: 8:36 AM
 */

namespace Aforance\Http\Controllers\Branch;


use Aforance\Aforance\Repository\BranchRepository;
use Aforance\Http\Controllers\Controller;

class BranchController extends Controller
{

    /**
     * @var BranchRepository
     */
    private $branches;

    public function __construct(BranchRepository $branches)
    {
        $this->branches = $branches;
    }

    public function all(){
        return $this->branches->all();
    }
    
}