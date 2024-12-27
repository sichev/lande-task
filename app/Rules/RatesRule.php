<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

final readonly class RatesRule implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (!is_array($value)) {
            $fail("Rates must be an array, '".gettype($value)."' type given");
        }

        if (empty($value)) {
            $fail('Rates must have at least 1 element');
        }

        foreach ($value as $investor => $rate) {
            if (!is_string($investor)) {
                $fail('Investor name (key) must be a string');
            }

            if (!is_numeric($rate)) {
                $fail('Share Rate must be a number');
            }
        }

        try {
            if (array_sum($value) !== 1.0) {
                $fail('Sum of all share rates must be 1.0');
            }
        } catch (\Throwable $e) {
            $fail($e->getMessage());
        }
    }
}
