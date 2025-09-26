<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Admin;

class AccountTypeFactory extends Factory
{
    protected $model = \App\Models\AccountType::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $types = [
            'Savings Account',
            'Current Account',
            'Fixed Deposit',
            'Loan Account',
            'Corporate Account',
            'Student Account',
            'Business Account',
            'Joint Account',
        ];

        return [
            'accountType' => $this->faker->unique()->randomElement($types),
            'added_by'    => Admin::inRandomOrder()->first()->id??null, // or User::factory()->id
            'dateTime'    => $this->faker->dateTimeThisYear(),
        ];
    }
}
