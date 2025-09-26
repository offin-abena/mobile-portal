<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\ActivityLog;
use App\Models\User;
use App\Models\AccessDevice;

class AccessDeviceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = AccessDevice::class;

    public function definition(): array
    {
         return [
            // Try to reference an existing user id, otherwise create one
            'user_id'     => User::query()->inRandomOrder()->value('id') ?? User::factory(),

            // Unique device code (UUID-ish)
            'device_code' => (string) \Str::uuid(),

            // platform enum: android or ios
            'platform'    => $this->faker->randomElement(['android', 'ios']),

            // status enum
            'status'      => $this->faker->randomElement(['active', 'inactive', 'suspended']),

            // timestamps (optional)
            'created_at'  => $this->faker->optional()->dateTimeThisYear(),
            'updated_at'  => $this->faker->optional()->dateTimeThisYear(),

            // optional account identifier (string)
            'account_id'  => $this->faker->optional()->bothify('ACCT-####-????'),

            // login_status numeric flag (e.g., 0 = logged out, 1 = logged in)
            'login_status' => $this->faker->optional()->randomElement([0, 1]),
        ];
    }
}
