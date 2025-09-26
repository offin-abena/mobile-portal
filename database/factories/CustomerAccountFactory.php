<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Customer;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CustomerAccount>
 */
class CustomerAccountFactory extends Factory
{
    protected $model = \App\Models\CustomerAccount::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id' => (string) \Str::uuid(),
            'balance' => $this->faker->randomFloat(4, 0, 10000),
            'customerID' => Customer::inRandomOrder()->first()?->id, // pick existing customer
            'remark' => 'PENDING',
            'credit' => $this->faker->randomFloat(4, 0, 5000),
            'idStatus' => $this->faker->randomElement(['MINIMUM', 'MEDIUM', 'ADVANCED', 'SPECIAL']),
            'debit' => $this->faker->randomFloat(4, 0, 5000),
            'commissionAccount' => $this->faker->randomFloat(4, 0, 100000),
            'quota' => $this->faker->randomFloat(4, 0, 100000),
            'countryCode' => 'GH',
            //'type' => $this->faker->word(),
            'dateTime' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
