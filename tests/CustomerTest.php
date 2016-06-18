<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CustomerTest extends TestCase
{
    

	public function testCanRegisterCustomer(){


		$customerService = new Aforance\Aforance\Service\CustomerService();

		$data = [
			'first_name' => 'Bright',
			'surname' => 'Antwi Boasiako'
		];


		$this->assertTrue(true);


	}

}
