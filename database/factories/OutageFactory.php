<?php

namespace Database\Factories;

use App\Models\Outage;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class OutageFactory extends Factory
{
    protected $model = Outage::class;

    public function definition(): array
    {
        return [
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'start' => Carbon::now(),
            'end' => Carbon::now(),
            'address' => $this->faker->address(),
        ];
    }
}
