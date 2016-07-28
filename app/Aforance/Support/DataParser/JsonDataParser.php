<?php 

namespace Aforance\Aforance\Support\DataParser;

use Aforance\Aforance\Support\Contracts\Parser;

class JsonDataParser implements Parser{


	private $fileContent = [];


	public function __construct($filePath){

		$file = fopen($filePath, 'r');
		$this->fileContent = json_decode(fread($file, filesize($filePath)), true);

		fclose($file);
	}


	public function read($key){

		if(isset($this->fileContent[$key])){
			return $this->fileContent[$key];
		}else{
			throw new ParserException($key .' does not exist in json file.');
		}
	}


	public function raw(){
		return json_encode($this->fileContent, true);
	}

	/**
	 * @return array
	 */
	public function readAll(){
		return $this->fileContent;
	}

}