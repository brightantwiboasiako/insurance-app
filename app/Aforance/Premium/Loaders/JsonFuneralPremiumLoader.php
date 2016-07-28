<?php
/**
 * Created by PhpStorm.
 * User: Bright
 * Date: 7/23/2016
 * Time: 8:10 AM
 */

namespace Aforance\Aforance\Premium\Loaders;


use Aforance\Aforance\Contracts\Business\FuneralPremiumLoader;
use Aforance\Aforance\Support\DataParser\JsonDataParser;

class JsonFuneralPremiumLoader implements FuneralPremiumLoader
{
    const FILE_PATH = '/files/premiums/funeral.json';

    /**
     * @var JsonDataParser
     */
    private $parser;

    public function __construct()
    {
        $this->parser = new JsonDataParser(base_path().self::FILE_PATH);
    }

    /**
     * Loads the premium rates for the funeral policy
     */
    public function loadRates()
    {
        return $this->parser->readAll();
    }

}