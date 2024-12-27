<?php

namespace App\Entities;

use Illuminate\Contracts\Support\Arrayable;

readonly class Rounding implements Arrayable
{
    public string $name;
    public float $rounding;

    public function __construct(string $name, float $rounding)
    {
        $this->name = $name;
        $this->rounding = $rounding;
    }

    public function toArray(): array
    {
        return [
            $this->name => $this->rounding,
        ];
    }
}
