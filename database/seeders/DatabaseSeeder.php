<?php

namespace Database\Seeders;

//use App\Models\User;
use Illuminate\Database\Seeder;
use App\Models\ActivityLog;
use App\Models\Admin;
use App\Models\Customer;
use App\Models\Maintransaction;
use App\Models\TsaTmTransaction;
use App\Models\User;
use App\Models\AccessDevice;
use App\Models\EcgNewData;
use App\Models\TsaTm;
use App\Models\UserEcgMter;
use App\Models\Service;
use App\Models\PricingPolicy;
use App\Models\UGroup;
use App\Models\AccountType;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        //Customer::factory(100)->create();
        //AccessDevice::factory(100)->create();
        //User::factory(100)->create();
        //ActivityLog::factory(100)->create();
        //EcgNewData::factory(100)->create();
        //Maintransaction::factory(500)->create();
        //TsaTmTransaction::factory(100)->create();
        //TsaTm::factory(100)->create();
        //UserEcgMter::factory(100)->create();
        Service::factory(8)->create();
        UGroup::factory(8)->create();
        AccountType::factory(8)->create();
        PricingPolicy::factory(10)->create();
    }
}
