<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         $this->call(SeedUsersTable::class);
         $this->call(SeedCustomersTable::class);
         $this->call(SeedOrdersTable::class);
    }
}
