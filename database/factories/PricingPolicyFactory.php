<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\UGroup;
use App\Models\AccountType;
use App\Models\Service;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class PricingPolicyFactory extends Factory
{
    protected $model = \App\Models\PricingPolicy::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'senderUGroup'            => UGroup::inRandomOrder()?->first()?->id,
            'senderAccountType'       => AccountType::inRandomOrder()?->first()?->id,
            'recipientUGroup'         => UGroup::inRandomOrder()?->first()?->id,
            'recipientAccountType'    => AccountType::inRandomOrder()?->first()?->id,
            'serviceType'             => Service::inRandomOrder()?->first()?->id,
            'price_in_percent_absolute' => $this->faker->randomFloat(4, 0, 100), // e.g. 45.1234
            'priceType'               => $this->faker->randomElement(['ABSOLUTE', 'PERCENTAGE']),
            'pricing_by'              => $this->faker->randomNumber(6, true), // bigint simulation
            'pricing_date'            => $this->faker->dateTimeThisYear(),
            'senderCountry'           => $this->faker->countryCode(), // e.g. 'US'
            'recipientCountry'        => $this->faker->countryCode(), // e.g. 'GH'
            'sysCommission'           => $this->faker->randomFloat(4, 0, 50),
            'senderCommission'        => $this->faker->randomFloat(4, 0, 50),
            'recipientCommission'     => $this->faker->randomFloat(4, 0, 50),
        ];
    }
}
