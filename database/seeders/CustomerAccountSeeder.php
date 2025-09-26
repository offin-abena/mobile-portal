<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\CustomerAccount;
use App\Models\Customer;

class CustomerAccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $customers = Customer::all();

        foreach ($customers as $customer) {
            CustomerAccount::factory()->create([
                'customerID' => $customer->id, // assign each customer only once
            ]);
        }
    }
}
