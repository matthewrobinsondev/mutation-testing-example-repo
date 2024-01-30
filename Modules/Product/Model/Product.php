<?php

namespace Modules\Product\Model;

class Product
{
    private const ZERO_PERCENT = 0;
    private const WHOLE_PERCENT = 100;

    public function __construct(
        private readonly int $id,
        private float        $price)
    {
    }

    public function applyDiscount(float $discountPercentage): void
    {
        if ($discountPercentage > self::ZERO_PERCENT && $discountPercentage <= self::WHOLE_PERCENT) {
            $this->price *= (1 - $discountPercentage / 100);
        }
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function getId(): int
    {
        return $this->id;
    }
}
