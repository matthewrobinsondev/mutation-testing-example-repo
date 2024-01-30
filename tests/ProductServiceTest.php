<?php

use Modules\Product\Model\Product;
use Modules\Product\Repository\ProductRepository;
use Modules\Product\Service\ProductService;
use PHPUnit\Framework\TestCase;

class ProductServiceTest extends TestCase
{
    private const DISCOUNT_PERCENT = 10;
    private const EXPECTED_DISCOUNT_VALUE = 90.0;
    private const PRODUCT_ID = 1;
    private const PRICE = 100.0;

    protected function setUp(): void
    {
        $this->repository = new ProductRepository();
        $this->service = new ProductService($this->repository);
    }

    public function testApplyDiscountToProduct()
    {
        $product = new Product(self::PRODUCT_ID);
        $product->setPrice(self::PRICE, 'GBP');

        $this->repository->save($product);
        $this->service->applyDiscountToProduct(self::PRODUCT_ID, self::DISCOUNT_PERCENT);

        $this->assertEquals(self::EXPECTED_DISCOUNT_VALUE, $product->getPrice('GBP'));
    }
}