<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class UGroupFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
         $groups = [
            'Admin',
            'Super Admin',
            'Moderator',
            'Customer',
            'Merchant',
            'Agent',
            'Support',
            'Finance',
            'Operations',
            'Developer',
        ];

        return [
            'groupName' => $this->faker->unique()->randomElement($groups),
            'added_by'  => $this->faker->randomNumber(6, true), // or User::factory()->id if related
            'dateTime'  => $this->faker->dateTimeThisYear(),
        ];
    }


}
