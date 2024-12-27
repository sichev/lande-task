<?php

namespace App\Entities;

use Illuminate\Contracts\Support\Arrayable;

readonly class Distribution implements Arrayable
{
    public int $amount;
    /** @var Share[] $shares */
    public array $shares;

    public function __construct(int $amount, array $shares)
    {
        $this->amount = $amount;
        $this->shares = $shares;
    }

    public function toArray(): array
    {
        $shares = [];
        foreach ($this->shares as $share)
            $shares += $share->toArray();

        return [
            'amount' => $this->amount,
            'shares' => $shares,
        ];
    }

}
