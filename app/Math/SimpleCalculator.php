<?php

namespace App\Math;

use App\Interfaces\CalculatorInterface;

class SimpleCalculator implements CalculatorInterface
{
    public function calculate(int $amount, array $investors): array
    {
        [$distribution, $roundings] = $this->calculateDistributions($amount, $investors);
        $total = array_sum($roundings);

        return [
            'amount' => $amount,
            'distribution' => $distribution,
            'total' => $total,
            'roundings' => $roundings,
        ];
    }

    private function calculateShare(int $amount, float $share, float $sum): float
    {
        return $amount * $share / $sum;
    }

    private function calculateDistributions(int $amount, array $shares): array
    {
        $ratesSum = array_sum($shares);
        $distributions = [];
        $roundings = [];
        foreach ($shares as $investor => $rate) {
            $share = $this->calculateShare($amount, $rate, $ratesSum);
            $distributions[$investor] = (int) floor($share);
            $roundings[$investor] = round($share - floor($share), 10);
        }

        return [$distributions, $roundings];
    }
}
