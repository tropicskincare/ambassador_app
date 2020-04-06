<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class SeedCustomersTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $files = [
            'customers-1.json',
            'customers-2.json',
            'customers-3.json',
            'customers-4.json',
            'customers-5.json',
            'customers-6.json',
            'customers-7.json',
            'customers-8.json',
        ];

        foreach ( $files as $file )
        {
            $json = file_get_contents(__DIR__ . '/data/' . $file);
            $customers = json_decode($json);

            foreach ( $customers as $customer )
            {
                \App\Customer::create([
                    'user_id' => '5dc395df-376c-41be-a739-6fc13584e143',
                    'firstname' => $customer->first_name,
                    'lastname' => $customer->last_name,
                    'email' => $customer->email,
                    'address' => $customer->address ?? '',
                    'city' => $customer->city ?? '',
                    'county' => $customer->county ?? '',
                    'postcode' => $customer->postcode ?? '',
                    'country' => $customer->country ?? '',
                    'created_at' => $customer->created_at,
                    'updated_at' => $customer->created_at,
                    'last_order_at' => $customer->last_order_at ?? null,
                    'total_order_value' => $customer->order_value ?? 0
                ]); 
            }
        } 
    }
}
