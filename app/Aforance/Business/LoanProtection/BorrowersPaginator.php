<?php
/**
 * Created by PhpStorm.
 * User: Bright
 * Date: 7/30/2016
 * Time: 4:36 PM
 */

namespace Aforance\Aforance\Business\LoanProtection;


use Illuminate\Pagination\Paginator;

class BorrowersPaginator extends Paginator
{

    public function __construct($items, $perPage, $currentPage, array $options)
    {
        parent::__construct($items, $perPage, $currentPage, $options);
    }

}