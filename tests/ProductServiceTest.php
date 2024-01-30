<?php

use Modules\Product\Model\Product;
use Modules\Product\Repository\ProductRepository;
use Modules\Product\Service\ProductService;
use PHPUnit\Framework\TestCase;

class ProductServiceTest extends TestCase
{
    protected function setUp(): void
    {

        $this->repository = new ProductRepository();
        $this->service = new ProductService($this->repository);
    }

    public function testApplyDiscountToProduct()
    {
        $product = new Product(1,100.0);

        $this->repository->save($product);
        $this->service->applyDiscountToProduct(1, 10);

        $this->assertEquals(90.0, $product->getPrice());
    }
}