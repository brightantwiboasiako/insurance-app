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
    {   //tables truncation
        foreach ($this->tables as $table) {
            DB::table($table)->truncate();
        }

        $this->call(MotorPolicyTableSeeder::class);
        $this->call(LifePolicyTableSeeder::class);
        $this->call(FuneralPolicyTableSeeder::class);
        $this->call(PolicyTypeTableSeeder::class);
    }
}
