<?php

use Illuminate\Database\Seeder;

class MotorPolicyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('motor_policies')->insert([[
                'policy_number' => 1,
                'customer_id' => 4,
                'staff_id' => 5,
                'sum_assured' => 868,
                'underwriting_premium' => 955,
            ],
            [
                'policy_number' => 2,
                'customer_id' => 2,
                'staff_id' => 4,
                'sum_assured' => 1559,
                'underwriting_premium' => 3221,
            ],
            [
                'policy_number' => 45,
                'customer_id' => 3,
                'staff_id' => 7,
                'sum_assured' => 2594,
                'underwriting_premium' => 391,
            ]]);
    }
}
