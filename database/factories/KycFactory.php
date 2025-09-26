<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Kyc>
 */
class KycFactory extends Factory
{
    protected $model = \App\Models\Kyc::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $levels = [
            [
                'name'              => 'Basic',
                'dailyAmount'       => 500.00,
                'monthlyAmount'     => 2000.00,
                'balance'           => 1000.00,
                'transaction_limit' => 200.00,
            ],
            [
                'name'              => 'Standard',
                'dailyAmount'       => 2000.00,
                'monthlyAmount'     => 10000.00,
                'balance'           => 5000.00,
                'transaction_limit' => 1000.00,
            ],
            [
                'name'              => 'Premium',
                'dailyAmount'       => 5000.00,
                'monthlyAmount'     => 25000.00,
                'balance'           => 15000.00,
                'transaction_limit' => 2500.00,
            ],
            [
                'name'              => 'Gold',
                'dailyAmount'       => 10000.00,
                'monthlyAmount'     => 50000.00,
                'balance'           => 30000.00,
                'transaction_limit' => 5000.00,
            ],
        ];

        $level = $this->faker->randomElement($levels);

        return [
            'countryCode'       => 'GHS',
            'name'              => $level['name'],
            'dailyAmount'       => $level['dailyAmount'],
            'monthlyAmount'     => $level['monthlyAmount'],
            'balance'           => $level['balance'],
            'transaction_limit' => $level['transaction_limit'],
        ];
    }
}
