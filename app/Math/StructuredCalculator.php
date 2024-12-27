<?php

namespace App\Math;

use App\Entities\Distribution;
use App\Entities\DistributionRequest;
use App\Entities\Rate;
use App\Entities\Rounding;
use App\Entities\Roundings;
use App\Entities\Share;
use App\Interfaces\CalculatorInterface;

class StructuredCalculator implements CalculatorInterface
{
    private DistributionRequest $request;

    public Distribution $distributions;
    public Roundings $roundings;


    /**
     * @param int $amount
     * @param Rate $rate
     * @param float $sumOfAllRates
     * @return float
     */
    private function calculateShare(int $amount, Rate $rate, float $sumOfAllRates): float
    {
        return $amount * ($rate->rate / $sumOfAllRates);
    }

    private function calculateDistribution(): void
    {
        $amount = $this->request->amount;
        $sumOfAllRates = $this->request->getSumOfAllRates();
        $distributions = [];
        $roundings = [];
        $total = 0;
        foreach ($this->request->rates as $rate) {
            $share = $this->calculateShare($amount, $rate, $sumOfAllRates);

            $distributions[] = new Share($rate->name, floor($share));
            $rounding = new Rounding($rate->name, round($share - floor($share), 10));
            $roundings[] = $rounding;
            $total += $rounding->rounding;
        }

        $this->distributions = new Distribution($amount, $distributions);
        $this->roundings = new Roundings($total, $roundings);
    }

    public function calculate(int $amount, array $investors): array
    {
        $this->request = new DistributionRequest($amount, $investors);
        $this->calculateDistribution();

        return [
            'amount' => $amount,
            'distribution' => $this->distributions->toArray()['shares'],
            'total' => $this->roundings->total,
            'roundings' => $this->roundings->toArray()['shares'],
        ];
    }
}
