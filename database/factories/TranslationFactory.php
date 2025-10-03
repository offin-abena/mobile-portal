<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Translation>
 */
class TranslationFactory extends Factory
{
    protected $model = \App\Models\Translation::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'category'   => $this->faker->randomElement(['auth', 'payments', 'notifications', 'general']),
            'feature'    => $this->faker->unique()->word(), // unique features
            'platform'   => $this->faker->randomElement(['web', 'mobile', 'ussd']),
            'keyz'       => $this->faker->unique()->lexify('key-????'), // unique keys like key-abcd
            'textz'      => $this->faker->unique()->sentence(), // avoid duplicate texts
            'created_at' => now(),
            'updated_at' => now(),

            // Translations (kept unique as well)
            'english'    => $this->faker->unique()->sentence(),
            'french'     => $this->faker->unique()->sentence(),
            'pidgin'     => $this->faker->unique()->sentence(),
            'swahili'    => $this->faker->unique()->sentence(),
            'spanish'    => $this->faker->unique()->sentence(),
            'arabic'     => $this->faker->unique()->sentence(),
        ];
    }
}
