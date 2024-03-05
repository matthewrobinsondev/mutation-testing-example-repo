<?php

declare(strict_types=1);

namespace Modules\Product\Service;

use Modules\Product\Repository\ProductRepository;

class ProductService
{
    public function __construct(private readonly ProductRepository $repository)
    {
    }

    public function applyDiscountToProduct(int $productId, float $discount): bool
    {
        $product = $this->repository->findById($productId);

        if ($product === null) {
            return false;
        }

        $product->applyDiscount($discount);

        return true;
    }
}
