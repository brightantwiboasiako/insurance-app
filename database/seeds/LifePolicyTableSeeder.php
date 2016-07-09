<?php

use Illuminate\Database\Seeder;

class LifePolicyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('life_policies')->insert([[
                'policy_number' => 1,
                'customer_id' => 1,
                'staff_id' => 4,
                'sum_assured' => 5000,
                'underwriting_premium' => 600,
            ],
            [
                'policy_number' => 2,
                'customer_id' => 1,
                'staff_id' => 3,
                'sum_assured' => 9666,
                'underwriting_premium' => 1000,
            ],
            [
                'policy_number' => 3,
                'customer_id' => 2,
                'staff_id' => 4,
                'sum_assured' => 544,
                'underwriting_premium' => 788,
            ],
            [
                'policy_number' => 4,
                'customer_id' => 2,
                'staff_id' => 4,
                'sum_assured' => 458,
                'underwriting_premium' => 655,
            ]]);
    }
}
