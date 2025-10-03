<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\capitalSettlement>
 */
class capitalSettlementFactory extends Factory
{
    protected $model = \App\Models\CapitalSettlement::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
       return [
            'bank_name'=> $this->faker->randomElement([
                                    'Absa Bank',
                                    'Standard Chartered',
                                    'Stanbic Bank',
                                    'Ecobank',
                                    'GCB Bank',
                                    'Fidelity Bank'
                                ]),
            'account_number'     => $this->faker->bankAccountNumber,
            'amount'             => $this->faker->randomFloat(2, 10, 100000), // between 10.00 and 100,000.00
            'authorization_code' => strtoupper($this->faker->bothify('AUTH####??')), // e.g AUTH1234AB
            'user'               => $this->faker->userName,
        ];
    }
}
