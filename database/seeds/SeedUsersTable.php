<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class SeedUsersTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\User::create([
            'firstname' => 'Ed',
            'lastname' => 'Raynham',
            'email' => 'ed@behindthedot.com',
            'password' => Hash::make('uxfbdv'),
        ]);
    }
}
