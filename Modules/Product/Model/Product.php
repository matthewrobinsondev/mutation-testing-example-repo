<?php

namespace Modules\Product\Model;

class Product
{
    private const ZERO_PERCENT = 0;
    private const WHOLE_PERCENT = 100;

    public function __construct(
        private readonly int $id)
    {
    }

    private array $prices = [];

    public function getId(): int
    {
        return $this->id;
    }

    public function applyDiscount(float $discountPercentage, float $price = null, string $currency = 'GBP'): void
    {
        if(empty($price)) {
            $price = $this->getPrice($currency);
        }

        if ($discountPercentage > self::ZERO_PERCENT && $discountPercentage <= self::WHOLE_PERCENT) {
            $price *= (1 - $discountPercentage / 100);
            $this->setPrice($price, $currency);
        }
    }

    public function getPrice(string $currency): ?float
    {
        return $this->prices[$currency] ?? null;
    }

    public function setPrice(float $price, string $currency): void
    {
        $this->prices[$currency] = round($price, 2);
    }
}
