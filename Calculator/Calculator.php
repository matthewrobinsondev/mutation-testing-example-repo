<?php

declare(strict_types=1);

namespace Calculator;
use InvalidArgumentException;

final class Calculator
{
    public function add(float $a, float $b): float
    {
        return $a + $b;
    }

    public function subtract(float $a, float $b): float
    {
        return $a - $b;
    }

    public function multiply(float $a, float $b): float
    {
        return $a * $b;
    }

    public function divide(float $a, float $b): float
    {
        if ($b == 0) {
            throw new InvalidArgumentException("Divider can't be zero.");
        }
        return $a / $b;
    }
}
