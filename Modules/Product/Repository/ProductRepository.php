<?php

namespace Modules\Product\Repository;

use Modules\Product\Model\Product;

class ProductRepository
{
    private array $products = [];

    public function save(Product $product): void {
        $this->products[$product->getId()] = $product;
    }

    public function findById(int $id): ?Product {
        return $this->products[$id] ?? null;
    }
}
