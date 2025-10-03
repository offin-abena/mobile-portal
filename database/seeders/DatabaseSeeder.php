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
use App\Models\ProviderService;
use App\Models\FundSource;
use App\Models\CapitalSettlement;
use App\Models\Translation;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        //Referrer::factory(100)->create();
        //ProviderService::factory(10)->create();

        //$this->call(UserFundSourcesSeeder::class);

        //FundSource::factory(10)->create();

        //CapitalSettlement::factory(100)->create();

        Translation::factory(10)->create();
    }
}
