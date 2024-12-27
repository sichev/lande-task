<?php

declare(strict_types=1);

namespace Tests\Unit\Rules;

use App\Rules\RatesRule;
use PHPUnit\Framework\TestCase;


class RatesRuleTest extends TestCase
{
    public function test_good_data()
    {
        $rates = [
            "a" => 0.5,
            "b" => 0.3,
            "c" => 0.2,
        ];

        (new RatesRule())->validate(
            attribute: 'rates',
            value: $rates,
            fail: fn () => $this->fail('Rates are invalid.'),
        );

        $this->assertTrue(true);
    }

    public function test_bad_data_string_provided()
    {
        try {
            (new RatesRule())->validate(
                attribute: 'investor_a',
                value: 'string',
                fail: fn($message) => $this->fail($message),
            );
            $this->fail("Should be an error: Rates must be an array, 'string' type given");
        } catch (\Throwable $th) {
            $this->assertEquals("Rates must be an array, 'string' type given", $th->getMessage());
        }
    }

    public function test_bad_data_empty_array_provided()
    {
        try {
            (new RatesRule())->validate(
                attribute: 'investor_a',
                value: [],
                fail: fn($message) => $this->fail($message),
            );
            $this->fail("Should be an error: Rates must have at least 1 element");
        } catch (\Throwable $th) {
            $this->assertEquals('Rates must have at least 1 element', $th->getMessage());
        }
    }

    public function test_bad_data_no_provider_names_provided()
    {
        try {
            (new RatesRule())->validate(
                attribute: 'investor_a',
                value: [ 0.5, 0.3, 0.2 ],
                fail: fn($message) => $this->fail($message),
            );
            $this->fail("Should be an error: Investor name (key) must be a string");
        } catch (\Throwable $th) {
            $this->assertEquals('Investor name (key) must be a string', $th->getMessage());
        }
    }

    public function test_bad_data_invalid_rate_provided()
    {
        try {
            (new RatesRule())->validate(
                attribute: 'investor_a',
                value: [ "a" => "half", "b" => 0.3, "c" => 0.2, "d" => 0.1 ],
                fail: fn($message) => $this->fail($message),
            );
            $this->fail("Should be an error: Share Rate must be a number");
        } catch (\Throwable $th) {
            $this->assertEquals('Share Rate must be a number', $th->getMessage());
        }
    }

    public function test_bad_data_invalid_rate_sum_provided()
    {
        try {
            (new RatesRule())->validate(
                attribute: 'investor_a',
                value: [ "a" => 0.5, "b" => 0.3, "c" => 0.2, "d" => 0.1 ],
                fail: fn($message) => $this->fail($message),
            );
            $this->fail("Should be an error: Sum of all share rates must be 1.0");
        } catch (\Throwable $th) {
            $this->assertEquals('Sum of all share rates must be 1.0', $th->getMessage());
        }
    }
}
