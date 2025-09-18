<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\Customer;
use App\Models\AccessDevice;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    protected $model = \App\Models\User::class;
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'uuid'                    =>  Customer::query()->inRandomOrder()->value('id') ?? Customer::factory(),
            'first_name'               => $this->faker->firstName(),
            'last_name'                => $this->faker->lastName(),
            'mobile_no'                => $this->faker->unique()->numberBetween(233200000000, 233599999999), // Ghana-style
            'account_verified'         => $this->faker->boolean(70), // 70% chance verified
            'password'                 => Hash::make('password'), // default password
            'agreed_terms_conditions'  => $this->faker->boolean(),
            'last_login'               => $this->faker->optional()->dateTimeThisYear(),
            'last_platform'            => $this->faker->optional()->randomElement(['web','android','ios','ussd']),
            'last_device_id'           => AccessDevice::query()->inRandomOrder()->value('id') ?? AccessDevice::factory(),
            'signup_platform'          => $this->faker->randomElement(['web','android','ios','ussd']),
            'status'                   => $this->faker->randomElement(['active','inactive','recovery_mode','locked','suspended']),
            'password_reset'           => $this->faker->boolean(),
            'created_at'               => now(),
            'updated_at'               => now(),
            'id_verification'          => $this->faker->randomElement(['YES','NO']),
            'notification_token'       => $this->faker->optional()->sha1(),
            'notification_type'        => $this->faker->optional()->randomElement(['FCM','APN','SMS']),
            'gender'                   => $this->faker->optional()->randomElement(['Male','Female','Other']),
            'region'                   => $this->faker->optional()->state(),
            'email'                    => $this->faker->unique()->safeEmail(),
            'onboard_source'           => $this->faker->randomElement(['Pay','Capital','Both']),
            'referral_code'            => $this->faker->optional()->lexify('REF????'),
            'authenticator_code'       => $this->faker->optional()->numberBetween(100000, 999999),
            'authenticator_expiry'     => $this->faker->optional()->unixTime()
        ];
    }


}
