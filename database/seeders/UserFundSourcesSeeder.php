<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\FundSource;

class UserFundSourcesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::all()->each(function ($user) {
            // Ensure one momo account
            FundSource::factory()->create([
                'user_id'     => $user->id,
                'source_type' => 'momo',
            ]);

            // Ensure one bank account
            FundSource::factory()->create([
                'user_id'     => $user->id,
                'source_type' => 'bank',
            ]);
        });
    }
}
