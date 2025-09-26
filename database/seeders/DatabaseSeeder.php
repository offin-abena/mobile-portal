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
use App\Models\Currency;
use App\Models\Kyc;
use App\Models\Referrer;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        //Customer::factory(100)->create();
        //AccessDevice::factory(1)->create();
        //User::factory(100)->create();
        //Admin::factory(100)->create();
        //ActivityLog::factory(100)->create();
        //EcgNewData::factory(100)->create();
        //Maintransaction::factory(100)->create();
        //TsaTmTransaction::factory(100)->create();
        //TsaTm::factory(100)->create();
        //UserEcgMter::factory(100)->create();
        //Service::factory(8)->create();
        //UGroup::factory(8)->create();
        //AccountType::factory(8)->create();
        //PricingPolicy::factory(10)->create();

        //$this->call(CustomerAccountSeeder::class);

        //Currency::factory(4)->create();
        //Kyc::factory(4)->create();

        Referrer::factory(100)->create();

    }
}
