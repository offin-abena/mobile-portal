<?php

namespace Database\Factories;
use App\Models\Service;
use App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\Factory;

class ServiceFactory extends Factory
{
    protected $model = Service::class;

    public function definition(): array
    {
       $generalServices = [
            'Payments',
            'Transfers',
            'Loans',
            'Airtime',
            'Bills',
            'Remittance',
        ];

        $serviceNames = [
            'Mobile Money Transfer',
            'Bank Transfer',
            'Utility Bill Payment',
            'Loan Repayment',
            'Airtime Top-up',
            'International Remittance',
        ];

        $min = $this->faker->randomFloat(4, 1, 100);
        $max = $this->faker->randomFloat(4, $min + 50, $min + 1000);

        return [
            'general_service'  => $this->faker->randomElement($generalServices),
            'serviceName'      => $this->faker->randomElement($serviceNames),
            'senderCountry'    => $this->faker->countryCode(),   // e.g. "GH"
            'recipientCountry' => $this->faker->countryCode(),   // e.g. "US"
            'minimum'          => $min,
            'maximum'          => $max,
            'added_by'         => Admin::inRandomOrder()->first()->id??null,
            'dateTime'         => $this->faker->dateTimeThisYear(),
        ];
    }
}
