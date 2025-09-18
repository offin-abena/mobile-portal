<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\UserEcgMter;
use App\Models\User;

class UserEcgMterFactory extends Factory
{
    protected $model = UserEcgMter::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    public function definition(): array
    {
        return [
             'user_id'    => User::inRandomOrder()?->first()?->id ,
             'meter_no'   => strtoupper($this->faker->bothify('MTR###??')),
             'meter_info' => $this->faker->paragraphs(2, true), // sample JSON or text
             'status'     => $this->faker->randomElement(['ACTIVE', 'INACTIVE']),
             'alias'      => $this->faker->optional()->word(),
             'created_at' => now(),
             'updated_at' => now(),
        ];
    }
}
