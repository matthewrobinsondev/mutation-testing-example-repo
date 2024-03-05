<?php

namespace tests;

use Generator;
use Modules\Product\Model\Product;
use Modules\Product\Repository\ProductRepository;
use Modules\Product\Service\ProductPricingService;

class ProductPricingServiceTest extends \PHPUnit\Framework\TestCase
{
    private const PRODUCT_ID = 1;
    private const GBP_VALUE = 100.00;
    private const USD_VALUE = 133.00;
    private const EUR_VALUE = 118.00;

    private ProductRepository $repository;
    private ProductPricingService $service;

    protected function setUp(): void
    {
        parent::setUp();

        $this->repository = new ProductRepository();
        $this->service = new ProductPricingService($this->repository);
    }

    /**
     * @dataProvider createBatchPricingDataProvider
     */
    public function testUpdatePrice(float $expected, string $currency): void
    {
        $product = new Product(self::PRODUCT_ID);

        $this->repository->save($product);

        $this->service->createBatchPricing(self::PRODUCT_ID, self::GBP_VALUE);

        $this->assertEquals($expected, $product->getPrice($currency));
    }

    public static function createBatchPricingDataProvider(): Generator
    {
        yield 'USD' => [
            'expected' => self::USD_VALUE,
            'currency' => 'USD',
        ];

        yield 'EUR' => [
            'expected' => self::EUR_VALUE,
            'currency' => 'EUR',
        ];

        yield 'GBP' => [
            'expected' => self::GBP_VALUE,
            'currency' => 'GBP',
        ];
    }
}
