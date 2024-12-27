<?php

namespace Database\Factories;

use App\Models\DistributionModel;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class DistributionModelFactory extends Factory
{
    protected $model = DistributionModel::class;

    public function definition(): array
    {
        return [
            'amount' => 0,
            'distribution' => [],
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
