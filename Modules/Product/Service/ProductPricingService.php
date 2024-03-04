<?php

namespace Modules\Product\Service;

use Modules\Product\Repository\ProductRepository;

class ProductPricingService
{
    /**
     * @var array<string, float> $currencyExchangeRates
     */
    private array $currencyExchangeRates;

    public function __construct(private readonly ProductRepository $repository)
    {
        $this->currencyExchangeRates = [
            'GBP' => 1.0,
            'USD' => 1.33,
            'EUR' => 1.18,
        ];
    }

    public function updatePrice(int $productId, float $newPrice, string $currency): void
    {
        $product = $this->repository->findById($productId);
        $product?->setPrice($newPrice, $currency);
    }

    public function createBatchPricing(int $productId, float $gbpPrice): void
    {
        $product = $this->repository->findById($productId);

        if ($product !== null) {
            foreach ($this->currencyExchangeRates as $currency => $rate) {
                $convertedPrice = $gbpPrice * $rate;
                $product->setPrice($convertedPrice, $currency);
            }
        }
    }

    public function applyConditionalDiscount(int $productId, float $discount, string $currency): void
    {
        $product = $this->repository->findById($productId);

        if ($product !== null && $this->isValidCurrency($currency) && $discount > 0 && $discount <= 100) {
            $currentPrice = $product->getPrice($currency);

            if ($currentPrice !== null) {
                $discountedPrice = $currentPrice * (1 - $discount / 100);
                $product->setPrice($discountedPrice, $currency);
            }
        }
    }

    private function isValidCurrency(string $currency): bool
    {
        return isset($this->currencyExchangeRates[$currency]);
    }
}
