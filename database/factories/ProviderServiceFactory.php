<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProviderService>
 */
class ProviderServiceFactory extends Factory
{
    protected $model = \App\Models\ProviderService::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $country = ['id' => 1, 'name' => 'Ghana'];

        // Ghanaian Telcos (strict mapping: momo category only)
        $telcos = [
            ['name' => 'MTN Ghana', 'category' => 'momo', 'channel' => 'mtn'],
            ['name' => 'Vodafone Ghana', 'category' => 'momo', 'channel' => 'vodafone'],
            ['name' => 'AirtelTigo Ghana', 'category' => 'momo', 'channel' => 'airtelTigo'],
            ['name' => 'Glo Ghana', 'category' => 'momo', 'channel' => 'glo'],
        ];

        // Ghanaian Banks (strict mapping: bank category only)
        $banks = [
            ['name' => 'GCB Bank', 'category' => 'bank', 'channel' => 'bank'],
            ['name' => 'Ecobank Ghana', 'category' => 'bank', 'channel' => 'bank'],
            ['name' => 'Absa Bank Ghana', 'category' => 'bank', 'channel' => 'bank'],
            ['name' => 'Stanbic Bank Ghana', 'category' => 'bank', 'channel' => 'bank'],
            ['name' => 'Fidelity Bank Ghana', 'category' => 'bank', 'channel' => 'bank'],
        ];

        // Randomly decide whether to pick a telco or bank
        $providerGroup = $this->faker->randomElement([$telcos, $banks]);
        $provider = $this->faker->randomElement($providerGroup);

        return [
            'name'           => $provider['name'],
            'routing_number' => strtoupper($this->faker->bothify('GH########')),
            'country_id'     => $country['id'],
            'country_name'   => $country['name'],
            'instructions'   => $this->faker->sentence,
            'logo'           => $this->faker->imageUrl(200, 200, 'business', true, 'logo'),
            'category'       => $provider['category'],
            'channel'        => $provider['channel'],
            'status'         => $this->faker->randomElement(['active', 'inactive']),
        ];

    }
}
