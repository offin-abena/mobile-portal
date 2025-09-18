<?php

namespace Database\Factories;

use App\Models\Admin;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Admin>
 */
class AdminFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Admin::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Generate a clean phone number without special characters
        //$phoneNumber = preg_replace('/[^0-9]/', '', $this->faker->phoneNumber());

        return [
            'fullName'    => $this->faker->name(),
            'username'    => $this->faker->unique()->userName(),
            'password'    => Hash::make('password'), // default password
            'userType'    => $this->faker->randomElement([
                'SYSTEMADMIN','ADMINISTRATOR','MANAGER','OPERATIONS',
                'VMANAGER','ACCOUNTANT','COMPLIANCE','FRONTDESK'
            ]),
            'userPIN'     => $this->faker->numberBetween(1000, 999999),
            'adminID'     => $this->faker->randomNumber(),
            'userCountry' => $this->faker->countryCode(),
            'status'      => $this->faker->randomElement(['ACTIVE','INACTIVE']),
            'phoneNum'    => $this->faker->unique()->phoneNumber(),
            'email'       => $this->faker->unique()->safeEmail(),
            'created_at'  => now(),
            'updated_at'  => now(),
        ];
    }
}
