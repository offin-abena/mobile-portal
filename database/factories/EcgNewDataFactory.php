<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\EcgNewData>
 */
class EcgNewDataFactory extends Factory
{
    protected $model = \App\Models\EcgNewData::class;

    public function definition(): array
    {
        $regions = [
            'Greater Accra',
            'Ashanti',
            'Eastern',
            'Western',
            'Western North',
            'Central',
            'Volta',
            'Oti',
            'Northern',
            'North East',
            'Savannah',
            'Upper East',
            'Upper West',
            'Bono',
            'Bono East',
            'Ahafo',
        ];

        $districts = [
            'Accra Metropolitan',
            'Kumasi Metropolitan',
            'Tema Metropolitan',
            'Ga East',
            'Ga West',
            'Ga South',
            'New Juaben',
            'Cape Coast',
            'Sekondi-Takoradi',
            'Tamale Metropolitan',
            'Bolgatanga',
            'Wa Municipal',
            'Sunyani Municipal',
            'Techiman Municipal',
            'Ho Municipal',
            'Keta Municipal',
        ];

        return [
            'district'        => $this->faker->randomElement($districts),
            'meteringSystem'  => $this->faker->randomElement(['Prepaid', 'Postpaid']),
            'phoneNumber'     => $this->faker->numerify('02########'), // Ghanaian phone format
            'region'          => $this->faker->randomElement($regions),
            'regionId'        => $this->faker->numberBetween(1, count($regions)),
            'districtId'      => $this->faker->numberBetween(1, count($districts)),
            'CMSID'           => strtoupper($this->faker->bothify('CMS###??')),
            'vendorId'        => $this->faker->numberBetween(1, 50),
            'vendorName'      => $this->faker->company,
            'vendorStatus'    => $this->faker->randomElement(['active', 'inactive', 'suspended']),
        ];
    }
}
