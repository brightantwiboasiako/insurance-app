<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Bright
        \Aforance\User::create([
            'name' => 'Bright Antwi Boasiako',
            'username' => 'brightantwiboasiako',
            'password' => bcrypt('aforanceappie100'),
            'email' => 'brightantwiboasiako@aol.com',
            'phone' => '0501373573',
            'role' => 'manager',
            'status' => 4112
        ]);

        // Jake
        \Aforance\User::create([
            'name' => 'Jake',
            'username' => 'jake',
            'password' => bcrypt('aforancejake'),
            'email' => 'Jacob.appia@yahoo.com',
            'phone' => '0542813807',
            'role' => 'manager',
            'status' => 4112
        ]);
    }
}
