<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Currency;
use App\Models\Admin;

class CurrencyFactory extends Factory
{
    protected $model = \App\Models\Currency::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $currencies = ['EUR', 'USD', 'GHS'];

        // Ensure convertFrom and convertTo are not the same
        $convertFrom = $this->faker->randomElement($currencies);
        $convertTo   = $this->faker->randomElement(array_diff($currencies, [$convertFrom]));

        return [
            'convertFrom'     => $convertFrom,
            'convertTo'       => $convertTo,
            'conversionRate'  => $this->faker->randomFloat(4, 0.1, 20), // realistic exchange rate
            'dateTime'        => now(),
            'updated_by'      => Admin::inRandomOrder()->value('id') ?? null,
            'updated_date'    => $this->faker->dateTimeBetween('-1 year', 'now'),
        ];
    }
}
