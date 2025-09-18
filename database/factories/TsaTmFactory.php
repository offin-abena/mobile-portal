<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\TsaTm;

class TsaTmFactory extends Factory
{
    protected $model = TsaTm::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    public function definition(): array
    {
        $otp = $this->faker->numerify('######');
        return [
            'phone_num'          => $this->faker->numerify('02#########'), // Ghana phone format
            'reference_code'     => strtoupper($this->faker->bothify('REF###??')),
            'full_name'          => $this->faker->name,
            'status'             => $this->faker->randomElement(['active', 'inactive', 'suspended']),
            'current_otp'        => $otp,
            'hashed_current_otp' => \Hash::make($otp),
            'password'           => \Hash::make('password123'),
            'amount_limit'       => $this->faker->randomFloat(2, 100, 10000),
        ];
    }
}
