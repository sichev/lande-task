<?php

namespace Database\Factories;

use App\Models\DistributionModel;
use App\Models\RoundingModel;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class RoundingModelFactory extends Factory
{
    protected $model = RoundingModel::class;

    public function definition(): array
    {
        return [
            'total' => 0,
            'roundings' => [],
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),

            'distribution_model_id' => DistributionModel::factory(),
        ];
    }
}
