<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\FundSource>
 */
class FundSourceFactory extends Factory
{
    protected $model = \App\Models\FundSource::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $sourceType = $this->faker->randomElement(['bank', 'momo']);

        if ($sourceType === 'momo') {
            $provider = \App\Models\ProviderService::where('category', 'momo')->inRandomOrder()->first();
        } else {
            $provider = \App\Models\ProviderService::where('category', 'bank')->inRandomOrder()->first();
        }

        return [
            'user_id' => User::inRandomOrder()->first()->id ?? 1,
            'provider_id' => $provider?->id ?? 1,
            'momo_number' => $this->faker->numerify('233#########'), // always generated
            'momo_name' => $this->faker->name,                     // always generated
            'status' => $this->faker->randomElement(['active', 'inactive', 'default']),
            'source_type' => $sourceType,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
