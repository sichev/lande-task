<?php

namespace Tests\Unit;

use App\Math\StructuredCalculator;
use PHPUnit\Framework\TestCase;

class StructuredCalculatorTest extends TestCase
{

    public function test_that_1000_is_distributed_equally_without_any_roundings(): void
    {
        $result = (new StructuredCalculator())->calculate(1000, ['a' => 0.5, 'b' => 0.3, 'c' => 0.2]);
        $this->assertEquals(1000, array_sum($result['distribution']));
        $this->assertEquals(0, $result['total']);
        $this->assertEquals(0, array_sum($result['roundings']));
    }

    public function test_that_999_is_distributed_correctly_with_correct_roundings(): void
    {
        $result = (new StructuredCalculator())->calculate(999, ['a' => 0.5, 'b' => 0.3, 'c' => 0.2]);
        $this->assertEquals(997, array_sum($result['distribution']));
        $this->assertEquals(2, $result['total']);
        $this->assertEquals(2, array_sum($result['roundings']));
        $this->assertEquals(0.5, $result['roundings']['a']);
        $this->assertEquals(0.7, $result['roundings']['b']);
        $this->assertEquals(0.8, $result['roundings']['c']);
    }
}
