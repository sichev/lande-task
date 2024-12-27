<?php

namespace App\Entities;

use Illuminate\Contracts\Support\Arrayable;

readonly class Share implements Arrayable
{

    public string $name;
    public int $share;

    public function __construct(string $name, int $share)
    {
        $this->name = $name;
        $this->share = $share;
    }

    public function toArray(): array
    {
        return [
            $this->name => $this->share,
        ];
    }
}
