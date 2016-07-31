<?php
/**
 * Created by PhpStorm.
 * User: Bright
 * Date: 7/31/2016
 * Time: 3:04 PM
 */

namespace Aforance\Aforance\Support\FileReader;


use Aforance\Aforance\Support\Contracts\FileReaderInterface;

class CsvFileReader implements FileReaderInterface
{

    public function read($path){

        // open the file
        $file = fopen($path, 'r');
        $data = [];
        // read the file contents
        while(!feof($file)){
            $data[] = fgetcsv($file);
        }
        fclose($file);

        return $data;

    }

}