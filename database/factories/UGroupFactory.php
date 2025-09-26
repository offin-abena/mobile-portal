<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Admin;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class UGroupFactory extends Factory
{
    protected $model = \App\Models\UGroup::class;

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
            'added_by'  => Admin::inRandomOrder()->first()->id??null, // or User::factory()->id if related
            'dateTime'  => $this->faker->dateTimeThisYear(),
            'created_at'=>now(),
            'updated_at'=>now(),
        ];
    }


}
