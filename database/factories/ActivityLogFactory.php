<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\ActivityLog;
use App\Models\Admin;

class ActivityLogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = ActivityLog::class;

    public function definition(): array
    {
        //\Log::info("Example faker",[$this->faker->numberBetween(1, 10)]);
         return [
            'userID'   => Admin::query()->inRandomOrder()->value('id') ?? Admin::factory(),
            'activity' => $this->faker->sentence(10), // short description of activity
            'action'   => $this->faker->randomElement([
                'LOGIN',
                'LOGOUT',
                'CREATE',
                'UPDATE',
                'DELETE',
                'VIEW',
                'EXPORT'
            ]),
            'dateTime' => $this->faker->dateTimeThisYear(),
        ];
    }
}
