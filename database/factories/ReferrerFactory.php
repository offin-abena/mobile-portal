<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ReferrerFactory extends Factory
{
    protected $model = \App\Models\Referrer::class;

    public function definition(): array
    {
        $ghanaRegions = [
            'Greater Accra',
            'Ashanti',
            'Western',
            'Central',
            'Volta',
            'Eastern',
            'Northern',
            'Upper East',
            'Upper West',
            'Brong Ahafo',
            'Western North',
            'Ahafo',
            'Bono',
            'Bono East',
            'Oti',
            'North East',
            'Savannah',
        ];

        return [
            'fullName' => $this->faker->name(),
            'phone' => $this->faker->unique()->phoneNumber(),
            'code' => $this->faker->unique()->phoneNumber(),
            'email' => $this->faker->unique()->safeEmail(),
            'gender' => $this->faker->randomElement(['male', 'female']),
            'region' => strtolower($this->faker->randomElement($ghanaRegions)),
            'referrer_type' => $this->faker->randomElement(['internal', 'external']),
            'code'=>strtoupper($this->faker->unique()->lexify('???') . $this->faker->unique()->numerify('###')),
        ];
    }
}
