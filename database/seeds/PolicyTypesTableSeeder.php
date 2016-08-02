<?php

use Illuminate\Database\Seeder;

class PolicyTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Aforance\PolicyType::create([
            'title' => 'FUNERAL POLICY',
            'identifier' => 'funeral',
            'options' => "{
                              \"automatic_update_percentages\": [
                                0,
                                7.5,
                                15,
                                20
                              ],
                              \"payment_methods\": [
                                \"CASH\",
                                \"CHEQUE\",
                                \"STANDING ORDER\",
                                \"DIRECT DEBIT\",
                                \"CAG\"
                              ],
                              \"payment_frequencies\": [
                                \"MONTHLY\",
                                \"QUARTERLY\",
                                \"SEMI-ANNUALLY\",
                                \"ANNUALLY\"
                              ],
                              \"supported_family\": [
                                \"spouse\",
                                \"child\",
                                \"parent\",
                                \"in_law\",
                                \"business_partner\"
                              ]
                            }"
        ]);
    }
}
