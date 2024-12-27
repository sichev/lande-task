<?php

namespace App\Entities;

readonly class DistributionRequest
{
    public int $amount;
    /** @var Rate[] $rates  */
    public array $rates;

    public function __construct(int $amount, array $rates)
    {
        $this->amount = $amount;
        $this->rates = $this->simpleArrayToRates($rates);
    }

    public function getSumOfAllRates(): int
    {
        return array_sum(array_map(fn(Rate $rate) => $rate->rate, $this->rates));
    }

    /**
     * @param array $rates
     * @return Rate[]
     */
    private function simpleArrayToRates(array $rates): array
    {
        $result = [];
        foreach ($rates as $key => $rate) {
            $result[] = new Rate($key, $rate);
        }

        return $result;
    }
}
