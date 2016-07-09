<?php

use Illuminate\Database\Seeder;

class FuneralPolicyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('funeral_policies')->insert([[
                'policy_number' => 12,
                'customer_id' => 2,
                'staff_id' => 1,
                'sum_assured' => 12112,
                'underwriting_premium' => 1457,
            ],
            [
                'policy_number' => 29,
                'customer_id' => 1,
                'staff_id' => 1,
                'sum_assured' => 9872,
                'underwriting_premium' => 5357,
            ],
            [
                'policy_number' => 2,
                'customer_id' => 4,
                'staff_id' => 1,
                'sum_assured' => 992,
                'underwriting_premium' => 7457,
            ]]);
    }
}
