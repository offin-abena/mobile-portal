<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TsaMgtTransaction>
 */
class TsaTmTransactionFactory extends Factory
{
    protected $model = \App\Models\TsaTmTransaction::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'reference_code'       => strtoupper(\Str::random(12)),
            'vendor_id'            => $this->faker->numberBetween(1, 50),
            'transaction_id'       => $this->faker->numberBetween(1000, 9999),
            'current_otp'          => (string) $this->faker->numberBetween(100000, 999999),
            'hashed_current_otp'   => bcrypt('123456'), // simulate hashing
            'amount'               => $this->faker->randomFloat(2, 10, 10000),
            'fulfilment_status'    => $this->faker->randomElement(['pending', 'processing', 'completed', 'failed']),
            'collection_status'    => $this->faker->randomElement(['pending', 'collected', 'failed']),
            'collection_mobile_no' => $this->faker->phoneNumber,
            'created_at'           => now()->subDays(rand(0, 365)),
            'updated_at'           => now(),
        ];
    }
}
