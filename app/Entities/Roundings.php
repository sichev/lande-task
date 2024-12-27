<?php

namespace App\Entities;

use Illuminate\Contracts\Support\Arrayable;

readonly class Roundings implements Arrayable
{
    public float $total;
    /** @var Rounding[] $roundings */
    public array $roundings;

    /**
     * @param int $total
     * @param Rounding[] $roundings
     */
    public function __construct(int $total, array $roundings)
    {
        $this->total = $total;
        $this->roundings = $roundings;
    }

    public function toArray(): array
    {
        $shares = [];
        foreach ($this->roundings as $share)
            $shares += $share->toArray();

        return [
            'shares' => $shares,
            'total' => $this->total,
        ];
    }
}
