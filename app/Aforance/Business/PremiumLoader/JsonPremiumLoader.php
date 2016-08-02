<?php
/**
 * Created by PhpStorm.
 * User: Bright
 * Date: 8/1/2016
 * Time: 3:18 AM
 */

namespace Aforance\Aforance\Business\PremiumLoader;

use Aforance\Aforance\Contracts\Business\PremiumLoader as LoaderContract;
use Aforance\Aforance\Support\DataParser\JsonDataParser;

class JsonPremiumLoader implements LoaderContract
{
    protected $parser;
    
    public function __construct($premiumFile)
    {
        $this->parser = new JsonDataParser($premiumFile);
    }


    public function loadRates()
    {
        return $this->parser->readAll();
    }


}