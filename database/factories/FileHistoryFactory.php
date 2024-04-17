<?php

namespace Database\Factories;

use App\Models\FileHistory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class FileHistoryFactory extends Factory
{
    protected $model = FileHistory::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'entries_amount' => $this->faker->randomNumber(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
