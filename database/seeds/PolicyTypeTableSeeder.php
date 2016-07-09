<?php

use Illuminate\Database\Seeder;

class PolicyTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('policy_types')->insert([
                'title' => 'LIFE ASSURANCE',
                'identifier' => 'life',
                'options' => ' ',
            ]);
    }
}
