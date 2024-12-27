<?php

namespace App\Entities;

readonly class Rate
{
    public string $name;
    public float $rate;

    public function __construct(string $name, float $rate)
    {
        $this->name = $name;
        $this->rate = $rate;
    }
}
