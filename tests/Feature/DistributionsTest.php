<?php

namespace Tests\Feature;

use App\Models\DistributionModel;
use App\Models\RoundingModel;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class DistributionsTest extends TestCase
{
    use RefreshDatabase;

    public function test_posting_and_viewing()
    {
        $this->artisan('migrate:fresh');

        $this->assertDatabaseCount(DistributionModel::class, 0);
        $this->assertDatabaseCount(RoundingModel::class, 0);
        $this
            ->json('POST', route('distribution.store'), [
                'amount' => 1000,
                'rates' => [
                    "investment_a" => 0.5,
                    "investment_b" => 0.3,
                    "investment_c" => 0.2,
            ]])
            ->assertStatus(201)
            ->assertJson(function (AssertableJson $json) {
                $json->has('id');
                $json->has('amount');
                $json->has('distribution');
            });
        $this->assertDatabaseCount(DistributionModel::class, 1);
        $this->assertDatabaseCount(RoundingModel::class, 1);

        $this
            ->get(route('distribution.index'))
            ->assertStatus(200)
            ->assertJson(function (AssertableJson $json) {
                $json->each(function (AssertableJson $jsonData) {
                    $jsonData->has('id');
                    $jsonData->has('amount');
                    $jsonData->has('distribution');
                });
            });

        $this
            ->get(route('distribution.roundings'))
            ->assertStatus(200)
            ->assertJson(function (AssertableJson $json) {
                $json->each(function (AssertableJson $jsonData) {
                    $jsonData->has('id');
                    $jsonData->has('total');
                    $jsonData->has('roundings');
                });
            });
    }

}
