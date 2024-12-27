<?php

namespace App\Interfaces;

interface CalculatorInterface
{
    public function calculate(int $amount, array $investors): array;
}
