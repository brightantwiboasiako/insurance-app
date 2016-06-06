<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PermissionsTest extends TestCase
{
    public function testCanReadJsonFile(){

    	$path = base_path().'/files/permissions.json';

		$jsonParser = new Aforance\Aforance\Support\DataParser\JsonDataParser($path);
		

		$this->assertEquals($jsonParser->raw(), $jsonParser->raw());

    }


    public function testCanCheckPermissions(){

    	$path = base_path().'/files/permissions.json';

		$jsonParser = new Aforance\Aforance\Support\DataParser\JsonDataParser($path);

		$checker = new Aforance\Aforance\Support\Permission\JsonPermissionChecker('customer', 'create', 'staff');


		$this->assertTrue($checker->allowed());

    }

}
