<?php 

namespace Aforance\Aforance\Support\Permission;

use Aforance\Aforance\Support\Contracts\Parser;
use Aforance\Aforance\Support\Contracts\Checker;
use Aforance\Aforance\Support\DataParser\JsonDataParser;
use Aforance\Aforance\Support\DataParser\ParserException;
use Aforance\Aforance\Support\Permission\InvalidPermissionException;

class JsonPermissionChecker implements Checker{


	/**
	* The service sought
	*
	* @var string
	*/
	private $service;


	/**
	* The action sought
	*
	* @var string
	*/
	private $action;


	/**
	* The role of the user seeking the permission
	*
	* @var int
	*/
	private $role;


	/**
	* A data parser
	* 
	* @var Parser
	*/
	private $parser;


	public function __construct($service = null, $action = null, $role = null){
		$this->service = $service;
		$this->role = $role;
		$this->action = $action;

		$this->parser = new JsonDataParser(base_path().'/files/permissions.json');
	}


	/**
	 * Checks if role is allowed to perform
	 * the given action
	 *
	 * @return bool
	 * @throws UnauthorizedActivityException
	 */
	public function allowed(){

		try{

			$servicePermission = $this->parser->read($this->service);

			if(!isset($servicePermission[$this->fullPermissionName()])){
				// sought permission is not available
				throw new UnauthorizedActivityException('Permission: ' . $this->fullPermissionName() . ' does not exist!');
			}

			if(array_search($this->role, $servicePermission[$this->fullPermissionName()]) === false){
				// role cannot perform operation
				return false;
			}else{
				return true;
			}

		}catch(ParserException $e){
			// @TODO: system problem, let's do some logging.

			return false;
		}

	}


	/**
	 * Checks if role is denied from performing
	 * the given action
	 *
	 * @return bool
	 * @throws UnauthorizedActivityException
	 */
	public function denied(){
		return !$this->allowed();
	}


	/**
	 * Gets the full permission name
	 *
	 * @return string
	 */
	private function fullPermissionName(){
		return $this->action.'_'.$this->service;
	}


	/**
	 * Sets the sought service
	 *
	 * @param $service
	 * @return $this
	 */
	public function service($service){
		$this->service = $service;
		return $this;
	}


	/**
	 * Sets the sought action
	 *
	 * @param $action
	 * @return $this
	 */
	public function action($action){
		$this->action = $action;
		return $this;
	}

	/**
	 * Sets the role for the checker
	 *
	 * @param $role
	 * @return $this
	 */
	public function role($role){
		$this->role = $role;
		return $this;
	}


}