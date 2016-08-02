<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    //tables to truncate before seeding
    protected $tables=['motor_policies','life_policies','funeral_policies'];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create users
        $this->call(UsersTableSeeder::class);

        // Create 10 customers
        factory(\Aforance\Customer::class, 10)->create();

        // create 5 agents, this will create 5 branches
        factory(\Aforance\Agent::class, 5)->create();

        // Policy types
        $this->call(PolicyTypesTableSeeder::class);

    }
}
